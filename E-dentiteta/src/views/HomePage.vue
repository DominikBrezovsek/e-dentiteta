<template>
  <ion-page>
    <ion-content :fullscreen="true" class="home">
      <h1 class="greet" v-for="item in user" :key="item.name">
        Pozdravljen, {{ item.name }}!
      </h1>
      <h3 class="subtittle">Moje izkaznice</h3>
      <ion-card
        v-for="item in card"
        :key="item.pot"
        @click="openCardDetails(item.naslov)"
        class="home_card"
      >
        <ion-card-title class="card_tittle">
          {{ item.naslov }}
        </ion-card-title>
        <ion-card-content>
          <img :src="item.pot" class="avatar" />
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
import axios from "axios";
import { defineComponent } from "vue";

interface Card {
  card_id: string;
  naslov: string;
  pot: string;
}
interface User {
  name: string;
}

export default defineComponent({
  data() {
    return {
      user: [] as User[],
      card: [] as Card[],
      token: localStorage.getItem("awtToken"),
    };
  },
  created() {
    axios
      .post("https://e-dentiteta.usdd.company/APIs/getUserInfo.php", null, {
        headers: {
          authorization: `Bearer ${this.token}`,
        },
      })
      .then((response) => {
        if (response.data == "token") {
          localStorage.removeItem("awtToken");
          (this as any).$router.push({ path: "/login" });
        }
        console.log(response.data);
        this.user = response.data.user;
        this.card = response.data.object;
        localStorage.setItem("card_id", response.data.object[0].id);

        console.log(this.user);
        console.log(this.card);
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
          if (response.data == "token") {
            localStorage.removeItem("awtToken");
            (this as any).$router.push({ path: "/login" });
          }
          console.log(response.data);
          localStorage.setItem("naslov", naslov);
          // Navigate to the CardDetails component and pass the response data as props
          (this as any).$router.push({
            path: "card-details",
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
.avatar {
  vertical-align: middle;
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
.subtittle {
  text-align: left;
  margin-top: 9%;
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
  padding: 2px;
}
.home_card ion-card-title {
  right: 5%;
  text-transform: uppercase;
}

.home {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.home h3 {
  margin-right: auto;
  color: black;
}
.home .greet {
  margin-left: auto;
  margin-top: 5%;
  margin-right: auto;
  font-weight: 600;
  color: black;
  font-size: 2.5rem;
}

.home.md .greet.md {
  margin-left: auto;
  margin-top: 5%;
  margin-right: auto;
  font-weight: 600;
  color: black;
  font-size: 2rem;
}

.card_tittle {
  text-transform: uppercase;
}
</style>
