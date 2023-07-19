<template>
  <ion-page cache="false">
    <ion-header>
      <ion-toolbar>
        <ion-title>Preverjanje veljavnosti kartice</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Preverjanje veljavnosti kartice</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-card>
        <ion-card-header>
          <ion-card-title>Skeniraj kartico</ion-card-title>
        </ion-card-header>
        <ion-card-content>
          <qrscanner/>
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
import QrScanner from "./QrScanner.vue";
import { defineComponent } from "vue";

export default defineComponent({
  components: {
    qrscanner: QrScanner,
  },
  data() {
    return {
      name: "",
      surname: "",
      email: "",
      showDismissibleAlert: false,
      link: "https://e-checker.usdd.company/APIs/",

    };
  },
  methods: {
    //
  },
});
</script>
<style>
ion-searchbar {
  background-color: antiquewhite;
}
ion-radio-group {
  display: flex;
  flex-wrap: wrap;
  max-height: 200px;
  max-width: 400px;
}
.error {
  font-weight: bold;
  color: red;
}
</style>
<style>
  ion-card{
    justify-content: center;
  }
  ion-button{
    text-transform: none;
    font-size: 2vh;
  }
  .avatar{
  vertical-align: middle;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  }
  .subtittle{
    text-align: left;
    margin-top: 5%;
    margin-left: 5%;
    font-weight: 600;
  }
  .home_card{
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

  .home_card img{
    height: auto;
    width: auto;
    border-radius: 0;
    background-color: white;
    padding: 2px;

  }
  .home_card ion-card-title{
    right: 5%;
    text-transform: uppercase;
  }
  ion-card {
  justify-content: center;
  background-color: #fdfbfb;
  outline: 3px solid #fdfbfb;
  color: #111111;
}
ion-button, .button-solid {
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
h3{
  color: #111111;
  --border-color: #fdfbfb;
}
</style>
