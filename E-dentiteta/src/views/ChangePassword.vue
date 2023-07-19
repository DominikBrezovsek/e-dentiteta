<template>
  <ion-page>
    <ion-content :fullscreen="true" class="password-main">
      <h2>Spremeni geslo</h2>
      <div class="change_password">
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
        <ion-button @click="passwordReplace()">Spremeni geslo</ion-button>
      </div>
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
            "https://e-dentiteta.usdd.company/APIs/changePassword.php",
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
      });
      await alert.present();
    },
  },
});
</script>
<style>
.change_password {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 25%;
  margin-bottom: 25%;
  height: 50%;
  width: 80%;
  margin-right: 10%;
  margin-left: 10%;
  background-color: #3587c3;
  color: white;
  border-radius: 10px;
  gap: 5%;
}

.change_password ion-input {
  color: white;
}

.change_password ion-item {
  width: 80%;
}

.change_password ion-button {
  margin-right: auto;
  margin-left: 15%;
}

h2 {
  color: black;
  margin-top: 8%;
  margin-left: 10%;
  font-weight: 600;
  font-size: 2rem;
}
.alert-wrapper.sc-ion-alert-ios,
.alert-wrapper.sc-ion-alert-md {
  background-color: #3587c3;
  color: white;
}
.alert-button.sc-ion-alert-ios,
.alert-button.sc-ion-alert-md {
  color: white;
}
</style>
