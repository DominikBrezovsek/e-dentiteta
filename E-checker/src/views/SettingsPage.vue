<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Nastavitve</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Nastavitve</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-card>
        <ion-card-header>
          <ion-card-header>
            <ion-card-title>Nastavitve</ion-card-title>
          </ion-card-header>
        </ion-card-header>
        <ion-card-content>
          <ion-card>
            <ion-card-header>
              <ion-card-title>Podatki za aplikacijo</ion-card-title>
            </ion-card-header>
            <ion-card-content>
              <ion-list>
                <ion-item id="email">
                  <p @click="copyToClipboard(userData.email)">
                    Uporabniško ime: {{ userData.email }}
                  </p>
                </ion-item>
                <ion-item>
                  <ion-button color="#cacaca" @click="changePassword"
                    >Spremeni geslo</ion-button
                  >
                </ion-item>
                <ion-item>
                  <ion-button color="#cacaca" @click="deleteUser"
                    >Izbirši uporabniški račun</ion-button
                  >
                </ion-item>
              </ion-list>
            </ion-card-content>
          </ion-card>
        </ion-card-content>
      </ion-card>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
import {
  IonPage,
  IonHeader,
  IonToolbar,
  IonTitle,
  IonContent,
  IonButton,
  IonCard,
  IonList,
  IonItem,
  IonCardHeader,
  IonCardContent,
  IonInput,
  IonCardTitle,
} from "@ionic/vue";
</script>
<script lang="ts">
import { defineComponent } from "vue";
import { toastController } from "@ionic/core";
import { alertController } from "@ionic/vue";
import axios from "axios";

interface User {
  email: string;
}

export default defineComponent({
  data() {
    return {
      userData: {} as User,
      link: "https://e-checker.usdd.company/APIs/",
    };
  },
  created() {
    const token = localStorage.getItem("awtToken");
    axios
      .post(
        this.link + "settings.php",
        {},
        {
          headers: {
            authorization: `Bearer ${token}`,
          },
        }
      )
      .then((response) => {
        if (response.data == "token") {
          localStorage.removeItem("awtToken");
          (this as any).$router.push({ path: "/login" });
        }
        console.log(response.data);
        this.userData = {
          email: response.data[0].email,
        };
        console.log(this.userData);
      })
      .catch((error) => {
        console.error(error);
      });
  },
  methods: {
    async copyToClipboard(text: string) {
      const input = document.createElement("input");
      input.setAttribute("value", text);
      document.body.appendChild(input);
      input.select();
      document.execCommand("copy");
      document.body.removeChild(input);
      const toast = await toastController.create({
        message: "Copied to clipboard.",
        duration: 1500,
        position: "bottom",
      });

      toast.present();
    },
    async changePassword() {
      (this as any).$router.push({ path: "change-password" });
    },
    async deleteUser() {
      const alert = await alertController.create({
        header: "Izbris uporabniškega računa",
        message:
          "Ali ste prepričani, da želite izbrisati vaš uporabniški račun?",
        cssClass: "alert-text-color",
        buttons: [
          {
            text: "Prekliči",
            role: "cancel",
            cssClass: "secondary",
          },
          {
            text: "Izbriši",
            handler: () => {
              this.deleteAcc("true");
            },
          },
        ],
      });
      await alert.present();
    },
    async deleteAcc(x: any) {
      if (x === "true") {
        const token = localStorage.getItem("awtToken");
        const formData = new FormData();
        formData.append("delete ", "true");
        axios.post(
          "https://e-dentiteta.usdd.company/APIs/delete_acc.php",
          formData,
          {
            headers: {
              authorization: `Bearer ${token}`,
            },
          }
        );

        localStorage.removeItem("awtToken");
        (this as any).$router.push({ path: "/login" });
      }
    },
  },
});
</script>
<style>
ion-card {
  justify-content: center;
}
ion-button {
  text-transform: none;
  font-size: 2vh;
}
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
