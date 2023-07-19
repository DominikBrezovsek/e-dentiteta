<template>
  <ion-page>
    <ion-tabs>
      <ion-router-outlet></ion-router-outlet>
      <ion-tab-bar slot="bottom" class="tab_bar">
        <ion-tab-button tab="login" href="/login" style="background-color: transparent;">
          <ion-icon name="login"></ion-icon>
        </ion-tab-button>
      </ion-tab-bar>
    </ion-tabs>
  </ion-page>
</template>

<script setup lang="ts">
import { IonTabBar, IonTabButton, IonTabs, IonLabel, IonIcon, IonPage, IonRouterOutlet } from '@ionic/vue';
import { addIcons } from 'ionicons';

addIcons({
  'login': 'assets/icon/log-in-outline.svg',
});
</script>
<style>
  ion-label{
    font-size: 2vh;
  }
.tab_bar{
  display: none;
}
</style>