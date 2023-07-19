<template>
  <ion-page>
    <ion-content :fullscreen="true">
      <h2>Prijava</h2>
      <div class="login">
        <p class="text">Za dostop do aplikacije se prijavite.</p>
        <div class="login-inputs">
          <ion-input
            v-model="username"
            type="text"
            placeholder="Vnesite uporabniško ime"
            required
          ></ion-input>
          <ion-input
            v-model="password"
            type="password"
            placeholder="Vnesite geslo"
            required
          ></ion-input>
          <ion-button fill="solid" @click="login()" color="#cacaca"
            >Prijava</ion-button
          >
        </div>
      </div>
    </ion-content>
  </ion-page>
</template>
<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";
import { alertController } from "@ionic/vue";

export default defineComponent({
  data() {
    return {
      username: "",
      password: "",
      showDismissibleAlert: false,
      link: "https://e-checker.usdd.company/APIs/",
    };
  },
  methods: {
    async login() {
      const token = localStorage.getItem("awtToken");
      if (this.username != "" && this.password != "" && token != undefined) {
        const formData = new FormData();
        formData.append("username", this.username);
        formData.append("password", this.password);
        const response = await axios.post(
          this.link + "login.php",
          formData,
          {
            headers: {
              authorization: `Bearer ${token}`,
              'Content-Type': 'multipart/form-data',
            },
          }
        );
        const success = response.data.success;
        if (success == "true") {
          this.username = "";
          this.password = "";
          localStorage.setItem("awtToken", response.data.jwt);
          (this as any).$router.push({ path: "/home/add-card" });
        } else if (response.data == "Invalid credentials.") {
          const alert = await alertController.create({
            header: "Napaka",
            subHeader: "Podatki",
            message: "Vnešeni podatki niso pravilni",
            buttons: ["V redu"],
            cssClass: "alert-text-color",
          });
          await alert.present();
        }
      } else if (this.username != "" && this.password != "") {
        const formData = new FormData();
        formData.append("username", this.username);
        formData.append("password", this.password);
        const response = await axios.post(this.link + "login.php", formData);
        const success = response.data.success;
        if (success == "true") {
          localStorage.setItem("awtToken", response.data.jwt);
          this.username = "";
          this.password = "";

          (this as any).$router.push({ path: "/home/add-card" });
        } else if (response.data == "Invalid credentials.") {
          const alert = await alertController.create({
            header: "Napaka",
            subHeader: "Podatki",
            message: "Vnešeni podatki niso pravilni",
            buttons: ["V redu"],
            cssClass: "alert-text-color",
          });
          await alert.present();
        }
      } else {
        const alert = await alertController.create({
          header: "Napaka",
          subHeader: "Neizpolnjeni podatki",
          message: "Uporabniško ime ali geslo ni vnešeno.",
          buttons: ["OK"],
          cssClass: "alert-text-color",
        });
        await alert.present();
      }
    },
  },
});
</script>
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
<style>
ion-card {
  justify-content: center;
}
ion-button {
  text-transform: none;
  font-size: 2vh;
}
.login {
  position: fixed;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  justify-content: center;
  height: 50%;
  margin-top: 10%;
  margin-bottom: 30%;
  margin-left: 30%;
  margin-right: 30%;
  width: 40%;
  background-color: rgba(50, 104, 185, 0.53);
  backdrop-filter: blur(5px);
  color: black;
  border-radius: 20px;
  padding: 4vh 1vh;
}
.login-inputs {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.login-inputs ion-input {
  margin-bottom: 2vh;
}
.login .login-inputs .loginBtn {
  margin-top: 2vh;
  background: linear-gradient(222deg, rgb(0 0 0) 0%, rgb(33 33 33) 45%, rgb(66 66 66 / 99%) 100%);
  border-radius: 25px;
  padding: 5% 30%;
}
h2{
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
.alert-text-color .alert-message{
  color: #111111;
  background-color: #999999;
}
.alert-text-color{
  color: #111111;
  background-color: #999999;
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
</style>
