<template>
  <ion-page>
    <ion-tabs>
      <ion-router-outlet></ion-router-outlet>
      <ion-tab-bar slot="bottom" class="homeBar">
        <ion-tab-button tab="add-card" href="/home/add-card" class="homeBar">
          <ion-icon name="add" class="icon"></ion-icon>
        </ion-tab-button>
        <ion-tab-button tab="add-type" href="/home/add-type" class="homeBar">
          <ion-icon name="type" class="icon"></ion-icon>
        </ion-tab-button>
        <ion-tab-button tab="scan-code" href="/home/scan-code" class="homeBar">
          <ion-icon name="scanqrcode" class="icon"></ion-icon>
        </ion-tab-button>
        <ion-tab-button tab="add-user" href="/home/add-user" class="homeBar">
          <ion-icon name="register" class="icon"></ion-icon>
        </ion-tab-button>
        <ion-tab-button tab="settings" href="/home/settings" class="homeBar">
          <ion-icon name="settings" class="icon"></ion-icon>
        </ion-tab-button>
        <ion-tab-button tab="logout" href="../login" @click="logout()" class="homeBar">
          <ion-icon class="icon" name="logout"></ion-icon>
        </ion-tab-button>
      </ion-tab-bar>
      
    </ion-tabs>
  </ion-page>
</template>
<style>
  ion-label{
    font-size: 2vh;
  }
  ion-tab-button{
  color: #fdfbfb
}
</style>
<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios';
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
            cssClass: "secondary"
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
          "https://e-checker.usdd.company/APIs/logout.php",
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
  }
});
</script>
<script setup lang="ts">

import { IonTabBar, IonTabButton, IonTabs, IonLabel, IonIcon, IonPage, IonRouterOutlet } from '@ionic/vue';
import { addIcons } from 'ionicons';
addIcons({
  'home': 'assets/icon/home.svg',
  'add': 'assets/icon/add.svg',
  'type': 'assets/icon/addCard.svg',
  'scanqrcode': 'assets/icon/scanqr.svg',
  'register': 'assets/icon/register-14.svg',
  'settings': 'assets/icon/settings.svg',
  'logout': 'assets/icon/logout.svg',
});
</script>
<style>
.alert-wrapper.sc-ion-alert-ios, .alert-wrapper.sc-ion-alert-md{
  background-color: #3587c3;
  color: white;
}
.alert-button.sc-ion-alert-ios, .alert-button.sc-ion-alert-md{
  color: white;
}
.homeBar{
  display: flex;
  background-color: #fdfbfb;
  color: #b4b4b4;
  border-top-color: #fdfbfb;
}
.icon:hover, .icon:active, .homeBar:hover > .icon, .homeBar:active > .icon{
  color: #696969;
}
</style>