<template>
  <div>
    <div v-if="error">
      {{ error }}
      <ion-button color="#cacaca" @click="startScanner"
        >Nisi prejel zahtevka za kamero? Klikni me</ion-button
      >
    </div>
    <ion-button v-if="qrCodeScanned" color="#cacaca" @click="startScanner"
      >Skeniraj še enkrat</ion-button
    >
    <div v-if="decodedData && !(id && lid && card)">
      <p>
        Pojdi na dekodirano povezavo:
        <a :href="decodedData">{{ decodedData }}</a>
      </p>
    </div>
    <div v-if="id && lid && card && cid && !error && qrCodeScanned">
      <p>
        Link: <a :href="decodedData">{{ decodedData }}</a>
      </p>
      <p>Dekodirana povezava:</p>
      <p>
        ID: <span>{{ id }}</span>
      </p>
      <p>
        Tip kartice: <span>{{ card }}</span>
      </p>
      <p>
        Link ID <span>{{ lid }}</span>
      </p>
      <p>
        ID kartice <span>{{ cid }}</span>
      </p>
      <ion-button color="#cacaca" @click="checkQR">Preveri QR kodo</ion-button>
    </div>
    <ion-button v-if="!qrCodeScanned" color="#cacaca" @click="stopScanner"
      >Ustavi skeniranje</ion-button
    >
    <video
      v-if="!qrCodeScanned"
      ref="video"
      style="width: 100%; height: auto"
    ></video>
    <canvas v-if="!qrCodeScanned" ref="canvas" style="display: none"></canvas>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";
import jsQR from "jsqr";
import { alertController } from "@ionic/vue";

interface User {
  name: string;
  surname: string;
  email: string;
  username: string;
}

export default defineComponent({
  data() {
    return {
      decodedData: null as string | null,
      error: "" as string,
      stream: null as MediaStream | null,
      qrCodeScanned: false,
      qrCodeUSDD: false,
      id: "",
      card: "",
      lid: "",
      cid: "",
      link: "https://e-checker.usdd.company/APIs/",
      showDismissibleAlert: false,
      userData: {} as User,
    };
  },
  methods: {
    async startScanner() {
      this.qrCodeScanned = false;
      try {
        // Access the user's camera
        this.stream = await navigator.mediaDevices.getUserMedia({
          video: {
            facingMode: "environment",
          },
        });

        // Set the video stream as the source for the video element
        const video = this.$refs.video as HTMLVideoElement;
        video.srcObject = this.stream;
        video.play();

        // Wait for the video stream to be ready
        await new Promise((resolve) => (video.onloadedmetadata = resolve));

        // Create a canvas element to capture video frames
        const canvas = this.$refs.canvas as HTMLCanvasElement;
        const context = canvas.getContext("2d")!;

        // Continuously capture video frames and try to decode them as QR codes
        const scan = async () => {
          if (!video.paused) {
            this.error = "";
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = context.getImageData(
              0,
              0,
              canvas.width,
              canvas.height
            );
            const code = jsQR(
              imageData.data,
              imageData.width,
              imageData.height,
              {
                inversionAttempts: "dontInvert",
              }
            );
            if (code) {
              this.decodedData = code.data;
              console.log(this.decodedData);
              this.stopScanner();
              this.qrCodeScanned = true;
              const urlRegex =
                /https:\/\/e-checker\.usdd\.company\/APIs\/qrconfirm\.php\?.*/;
              if (urlRegex.test(this.decodedData)) {
                // Extract the query parameters from the URL
                const idRegex = /id=([^&]*)/;
                const cardRegex = /card=([^&]*)/;
                const lidRegex = /lid=([^&]*)/;
                const cidRegex = /cid=([^&]*)/;
                this.id = this.decodedData.match(idRegex)?.[1] ?? "";
                this.card = this.decodedData.match(cardRegex)?.[1] ?? "";
                this.lid = this.decodedData.match(lidRegex)?.[1] ?? "";
                this.cid = this.decodedData.match(cidRegex)?.[1] ?? "";
              }
            }
          }
          requestAnimationFrame(scan);
        };
        scan();
      } catch (error) {
        this.error = (error as Error).message ?? "";
      }
    },
    stopScanner() {
      if (this.stream) {
        this.stream
          .getTracks()
          .forEach((track: MediaStreamTrack) => track.stop());
        this.stream = null;
      }
      this.qrCodeScanned = true;
    },
    async checkQR() {
      const formData = new FormData();
      formData.append("id", this.id);
      formData.append("cid", this.cid);
      formData.append("lid", this.lid);
      const token = localStorage.getItem("awtToken");
      const response = await axios.post(
        this.link + "verifyUser.php",
        formData,
        {
          headers: {
            authorization: `Bearer ${token}`,
          },
        }
      );
      if (response.data !== undefined) {
        this.userData = {
          name: response.data[0].name,
          surname: response.data[0].surname,
          email: response.data[0].email,
          username: response.data[0].username,
        };
        const alert = await alertController.create({
          header: "OK",
          message: `✔Uporabnik prepoznan✔
                <br>Ime: ${this.userData.name}
                <br>Priimek: ${this.userData.surname}
                <br>Email: ${this.userData.email}
                <br>Uporabniško ime: ${this.userData.username}
                <br>Tip kartice: ${this.card}`,
          cssClass: "alert-text-color",
          buttons: ["V redu"],
        });
        await alert.present();
        console.log(this.userData.name);
      } else if (response.data == "token") {
        localStorage.removeItem("awtToken");
        (this as any).$router.push({ path: "/login" });
      }
    },
  },
  ionViewDidLeave() {
    // Stop the scanner when the user leaves the tab
    this.stopScanner();
  },
  async mounted() {
    await this.startScanner();
  },
  computed: {
    errorString(): string {
      return this.error;
    },
  },
  beforeUnmount() {
    this.stopScanner();
  },
});
</script>
<style>
.avatar {
  vertical-align: middle;
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
.subtittle {
  text-align: left;
  margin-top: 5%;
  margin-left: 5%;
  font-weight: 600;
}
.home_card {
  margin-top: 5%;
  margin-right: auto;
  margin-left: auto;
  width: 90%;
  height: 30%;
  display: flex;
  flex-flow: row-reverse;
  align-items: center;
  gap: 20%;
  justify-content: space-between;
}

.home_card img {
  height: auto;
  width: auto;
  border-radius: 0;
  background-color: white;
  padding: 2px;
}
.home_card ion-card-title {
  right: 5%;
  text-transform: uppercase;
}
ion-card {
  justify-content: center;
  background-color: #fdfbfb;
  outline: 3px solid #fdfbfb;
  color: #111111;
}
ion-button,
.button-solid {
  color: #fdfbfb;
  text-transform: none;
  font-size: 2vh;
  background-color: #999999;
  border-radius: 50px;
  --box-shadow: none !important;
  height: 3vh;
}
ion-searchbar {
  background-color: #fdfbfb;
}
ion-radio-group {
  display: flex;
  flex-wrap: wrap;
  max-height: 200px;
  max-width: 400px;
  color: #111111;
  --box-shadow: unset;
}
ion-header {
  background-color: #fdfbfb !important;
}
ion-input,
ion-card-title,
ion-item,
ion-select,
ion-list-header,
h1,
h2,
h3 {
  color: #111111;
  --border-color: #fdfbfb;
}
#alert-3-msg,
.alert-title.sc-ion-alert-md,
.alert-button.sc-ion-alert-ios,
.alert-button.sc-ion-alert-md,
.alert-message.sc-ion-alert-md,
.alert-input-group.sc-ion-alert-md {
  color: #111111;
}
.alert-wrapper.sc-ion-alert-ios,
.alert-wrapper.sc-ion-alert-md {
  background-color: #999999;
  color: #111111;
}
.alert-message.sc-ion-alert-md,
.alert-input-group.sc-ion-alert-md {
  color: var(--ion-color-step-550, #111111);
}
.alert-text-color {
  color: #111111;
}
.alert-text-color .alert-message {
  color: #111111;
  background-color: #999999;
}
</style>
