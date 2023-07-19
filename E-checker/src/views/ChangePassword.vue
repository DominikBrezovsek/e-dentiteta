<template>
  <ion-page>
    <ion-content :fullscreen="true" class="password-main">
      <ion-card>
        <ion-card-header>
          <ion-card-title><h2>Spremeni geslo</h2></ion-card-title>
        </ion-card-header>
        <ion-card-content>
          <ion-list>
            <ion-item>
              <ion-input
                type="password"
                placeholder="Novo geslo"
                v-model="newPassword"
              ></ion-input>
            </ion-item>
            <ion-item>
              <ion-input
                type="password"
                placeholder="Ponovi novo geslo"
                v-model="newPasswordRepeat"
              ></ion-input>
            </ion-item>
            <ion-button @click="passwordReplace()" color="#cacaca"
              >Spremeni geslo</ion-button
            >
          </ion-list>
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
import { alertController } from "@ionic/vue";
import axios from "axios";

export default defineComponent({
  data() {
    return {
      newPassword: "",
      newPasswordRepeat: "",
      showDismissibleAlert: false,
    };
  },
  methods: {
    async passwordReplace() {
      const token = localStorage.getItem("awtToken");
      if (
        this.newPassword === this.newPasswordRepeat &&
        this.newPassword != "" &&
        this.newPasswordRepeat != ""
      ) {
        const newPassword = this.newPassword;
        const newPasswordRepeat = this.newPasswordRepeat;
        const formData = new FormData();
        formData.append("newPassword", newPassword);
        axios
          .post(
            "https://e-checker.usdd.company/APIs/changePassword.php",
            formData,
            {
              headers: {
                authorization: `Bearer ${token}`,
              },
            }
          )
          .then((response) => {
            console.log(response.data);
            if (response.data == "true") {
              this.presentAlert("Geslo je bilo uspešno spremenjeno");
            } else if (response.data == "token") {
              localStorage.removeItem("awtToken");
              (this as any).$router.push({ path: "/login" });
            }
          });
      } else {
        this.presentAlert2("Gesli se ne ujemata");
      }
    },
    async presentAlert(message: string) {
      const alert = await alertController.create({
        header: "Sprememba gesla",
        message: message,
        buttons: ["V redu"],
        cssClass: "alert-text-color",
      });
      await alert.present();
      this.newPassword = "";
      this.newPasswordRepeat = "";
      this.$router.push("settings");
    },
    async presentAlert2(message: string) {
      const alert = await alertController.create({
        header: "Napaka",
        message: message,
        buttons: ["V redu"],
        cssClass: "alert-text-color",
      });
      await alert.present();
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
