<template>
  <ion-page>
    <ion-content :fullscreen="true" class="cards">
      <h2>Izkaznice</h2>
        <ion-card v-for="item in object" :key="item.naslov" @click="openCardDetails(item.naslov)" class="id_card">
          <ion-card-header>
            <ion-card-title>{{ item.naslov }}</ion-card-title>
          </ion-card-header>
          <ion-card-content>
            <img :src="item.pot" />
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
  IonNav,
  IonNavLink,
} from "@ionic/vue";
import { useRouter } from "vue-router";
</script>
<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";

interface Card {
  naslov: string;
  pot: string;
  type: string;
  image: string;
  DOE: string;
  name: string;
  surname: string;
  emso: string;
}

export default defineComponent({
  data() {
    return {
      object: [] as Card[],
      token: localStorage.getItem("awtToken"),
    };
  },
  created() {
    axios
      .post("https://e-dentiteta.usdd.company/APIs/cards.php", null ,{
        headers: {
          authorization: `Bearer ${this.token}`,
        },
      })
      .then((response) => {
        console.log(response.data);
        // Extract the "object" property from the response data
        this.object = response.data.object;
      })
      .catch((error) => {
        console.error(error);
      });
  },
  methods: {
    openCardDetails(naslov: string) {
      const formData = new FormData();
      formData.append("type", naslov);
      axios
        .post("https://e-dentiteta.usdd.company/APIs/card.php", formData, {
        headers: {
          authorization: `Bearer ${this.token}`,
        },
      })
        .then((response) => {
          console.log(response.data);
          localStorage.setItem("naslov",naslov);
          // Navigate to the CardDetails component and pass the response data as props
          (this as any).$router.push({
            path: "card-details"
          });
        })
        .catch((error) => {
          console.error(error);
        });
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
.id_card{
    margin-top: 5%;
    margin-right: auto;
    margin-left: auto;
    width: 90%;
    height: 60%;
    display: flex;
    flex-flow: row-reverse;
    align-items: center;
    gap: 20%;
    justify-content: space-between;
  }

  .id_card.ios{
     display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    align-items: center;
    height: 25vh;
    gap: 5vw !important;
  }
  .id_card img{
    border-radius: 0;
    padding: 2px;

  }
  .id_card ion-card-title{
    right: 0;
    text-transform: uppercase;
  }

  .cards{
    display: flex;
    flex-direction: column;
  }
  .cards h2{
    margin-top: 5%;
    margin-right: auto;
    margin-left: 5px;
    font-weight: 600;
    color: black;
    font-size: 2.5rem;
  }

  .md .id_card{
    height: 25%;
  }
</style>