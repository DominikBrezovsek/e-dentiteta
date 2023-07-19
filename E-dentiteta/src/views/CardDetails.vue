<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-back-button></ion-back-button>
        </ion-buttons>
        <ion-title>Podatki o kartici</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content>
      <ion-card v-if="cardData">
        <ion-card-header>
          <ion-card-title style="text-transform: uppercase">{{
            cardData.type
          }}</ion-card-title>
        </ion-card-header>
        <ion-card-content
          style="display: flex; flex-flow: column"
          class="details"
        >
          <q-r-code-card />
          <p>Ime: {{ cardData.name }}</p>
          <p>Priimek: {{ cardData.surname }}</p>
          <p>Tip izkaznice: {{ cardData.type }}</p>
          <p>Datum veljavnosti: {{ cardData.DOE }}</p>
        </ion-card-content>
      </ion-card>
      <p v-else>Loading...</p>
      <p v-if="error">{{ error }}</p>
    </ion-content>
  </ion-page>
</template>
<script setup lang="ts">
import {
  IonPage,
  IonHeader,
  IonContent,
  IonCard,
  IonCardHeader,
  IonCardContent,
  IonCardTitle,
  IonIcon,
  IonToolbar,
  IonButtons,
  IonBackButton,
  IonTitle,
  IonButton,
} from "@ionic/vue";
import { addIcons } from "ionicons";
addIcons({
  verify: "assets/icon/verify.svg",
});
</script>
<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";
import QRCodeCard from "./QRCodeCard.vue";

interface Card {
  name: string;
  surname: string;
  DOE: string;
  type: string;
  emso: string;
  image: string;
}

export default defineComponent({
  data() {
    return {
      cardData: {} as Card,
    };
  },
  created() {
    const naslov = localStorage.getItem("naslov");
    const id = localStorage.getItem("card_id");
    const formData = new FormData();
    if (naslov == null) {
      console.log("Napaka pri nalaganju podatkov");
      return;
    }
    formData.append("type", naslov);
    axios
      .post("https://e-dentiteta.usdd.company/APIs/card.php", formData, {
        headers: {
          authorization: `Bearer ${localStorage.getItem("awtToken")}`,
        },
      })
      .then((response) => {
        if(response.data == "token"){
          localStorage.removeItem("awtToken");
          (this as any).$router.push({ path: "/login" });
        }
        console.log(response.data);
        this.cardData = {
          name: response.data[0].name,
          surname: response.data[0].surname,
          DOE: response.data[0].DOE,
          type: response.data[0].type,
          emso: response.data[0].emso,
          image: response.data[0].image,
        };
        console.log(this.cardData);
      })
      .catch((error) => {
        console.error(error);
      });
  },
  methods: {
    //
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

.details p {
  font-size: 1.2rem;
  font-weight: 500;
  color: black;
}

.details img {
  margin-bottom: 1rem;
  height: 20%;
  width: auto;
}
</style>
