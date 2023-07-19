<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Preverjanje veljavnosti</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Preverjanje veljavnosti</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-card>
        <ion-card-content
          style="text-align: center; font-size: x-large; color: green"
        >
          Kartica je veljavna
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
} from "@ionic/vue";
</script>

<script lang="ts">
import axios from "axios";
export default {
  name: "YepVeljavno",
  created() {
    const searchParams = new URLSearchParams(window.location.search);
    const value: string | null = searchParams.get("lid");
    console.log(value);
    const myParam = "abcabcabcabcabcabcabcabc123123123123";
    if (value == null) {
      console.log("ne dela!");
      (this as any).$router.push({ path: "/login" });
      // TypeScript now knows that the value is not null, so it can safely assign it to a variable of type string
    }
    else{

    const myParam = value;
    console.log(myParam); // TypeScr
    if(myParam != "abcabcabcabcabcabcabcabc123123123123"){
      const formData = new FormData();
      formData.append("lid", myParam);

      axios
      .post("https://e-checker.usdd.company/APIs/lid.php", formData)
      .then((response) => {
        console.log(response.data);
        if(response.data.success != "true"){
          (this as any).$router.push({ path: "/login" });
        }
      })
      .catch((error) => {
        console.error(error);
      });
    }
    else{
      console.log("ne dela!");
    }
  }
    
  },
};
</script>

<style>
ion-card {
  justify-content: center;
}
ion-button {
  text-transform: none;
  font-size: 2vh;
}
.id_card {
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

.id_card.ios {
  display: flex;
  flex-direction: row-reverse;
  justify-content: center;
  align-items: center;
  height: 25vh;
  gap: 5vw !important;
}
.id_card img {
  border-radius: 0;
  background-color: white;
  padding: 2px;
}
.id_card ion-card-title {
  right: 0;
  text-transform: uppercase;
}
</style>
