<template>
  <ion-page>
    <ion-tabs>
      <ion-router-outlet></ion-router-outlet>
      <ion-tab-bar slot="bottom">
        <ion-tab-button tab="denied" href="/verification/denied">
        </ion-tab-button>
        <ion-tab-button tab="ok" href="/verification/ok">
        </ion-tab-button>
        <ion-tab-button tab="login" href="/verification/login">
        </ion-tab-button>
      </ion-tab-bar>
      
    </ion-tabs>
  </ion-page>
</template>
<style>
  ion-label{
    font-size: 2vh;
  }
</style>
<script setup lang="ts">

import { IonTabBar, IonTabButton, IonTabs, IonLabel, IonIcon, IonPage, IonRouterOutlet } from '@ionic/vue';
</script>