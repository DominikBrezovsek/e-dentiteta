<template>
  <ion-page>
    <ion-tabs>
      <ion-router-outlet></ion-router-outlet>
      <ion-tab-bar slot="bottom">
        <ion-tab-button tab="home" href="/home/home">
          <ion-icon name="home"></ion-icon>
        </ion-tab-button>
        <ion-tab-button tab="id" href="/home/id">
          <ion-icon name="id"></ion-icon>
        </ion-tab-button>
        <ion-tab-button tab="settings" href="/home/settings">
          <ion-icon name="settings"></ion-icon>
        </ion-tab-button>
        <ion-tab-button tab="logout" @click="CreateController()">
          <ion-icon name="logout"></ion-icon>
        </ion-tab-button>
      </ion-tab-bar>
    </ion-tabs>
  </ion-page>
</template>
<style>
ion-label {
  font-size: 2vh;
}
</style>
<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";
import { alertController } from "@ionic/vue";
export default defineComponent({
  methods: {
    async CreateController() {
      const alert = await alertController.create({
        header: "Odjava",
        message: "Ali ste prepričani, da se želite odjaviti?",
        buttons: [
          {
            text: "Prekliči",
            role: "cancel",
            cssClass: "secondary",
          },
          {
            text: "Odjava",
            handler: () => {
              this.logout("true");
            },
          },
        ],
      });
      await alert.present();
    },

    logout(x: any) {
      if (x === "true") {
        const token = localStorage.getItem("awtToken");
        const formData = new FormData();
        formData.append("logout", "true");
        axios.post(
          "https://e-dentiteta.usdd.company/APIs/logout.php",
          formData,
          {
            headers: {
              authorization: `Bearer ${token}`,
            },
          }
        );

        localStorage.removeItem("awtToken");
        localStorage.removeItem("really");
        (this as any).$router.push({ path: "/login" });
      }
    },
  },
});
</script>
<script setup lang="ts">
import {
  IonTabBar,
  IonTabButton,
  IonTabs,
  IonLabel,
  IonIcon,
  IonPage,
  IonRouterOutlet,
} from "@ionic/vue";
import { addIcons } from "ionicons";
addIcons({
  home: "assets/icon/home.svg",
  id: "assets/icon/id.svg",
  profile: "assets/icon/profile.svg",
  settings: "assets/icon/settings.svg",
  logout: "assets/icon/logout.svg",
});
</script>
<style>
.alert-wrapper.sc-ion-alert-ios,
.alert-wrapper.sc-ion-alert-md {
  background-color: #3587c3;
  color: white;
}
.alert-button.sc-ion-alert-ios,
.alert-button.sc-ion-alert-md {
  color: white;
}
.alert-message.sc-ion-alert{
  color: white;
}
</style>
