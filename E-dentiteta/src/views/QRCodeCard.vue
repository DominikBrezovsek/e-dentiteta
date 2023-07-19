<template>
  <div class="qrcode" v-if="value">
            <vue-qrcode
              :value= "value"
              tag="svg"
              class="qrcode_code"
              :options="{
                errorCorrectionLevel: 'Q',
                width: 300,
              }"
            ></vue-qrcode>
            <img :src="logo" alt="E-dentiteta" class="qrcode__image">
            </div>
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
  IonButtons,
  IonBackButton,
  IonIcon,
} from "@ionic/vue";
import { addIcons } from "ionicons";
addIcons({
  logo: "assets/icon/logo.png",
});
</script>
<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";

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
      logo: "assets/icon/logo.png",
      value: "",
    };
  },
  created() {
    const naslov = localStorage.getItem("naslov");
    const id = localStorage.getItem("card_id");
    const formData = new FormData();
    if(naslov != null && id != null){
        formData.append("tip", naslov);
        formData.append("id", id);
    }
    else{
        //(this as any).$router.push({ path: "card-details" });
    }
    const token = localStorage.getItem("awtToken");
    axios
      .post("https://e-dentiteta.usdd.company/APIs/cardverify.php",
        formData,{
          headers:{
            authorization: `Bearer ${token}`,
          }
        }
      )
      .then((response) => {
        if(response.data == "token"){
          localStorage.removeItem("awtToken");
          (this as any).$router.push({ path: "/login" });
        }
        console.log(response.data);
        this.value = response.data;
        console.log(this.value);
      })
      .catch((error) => {
        console.error(error);
      });
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
</style>
<style scoped>
.qrcode {
position: relative;
text-align: center; /* Set the text alignment of the container to center */
}

.qrcode__image {
background-color: #fff;
border: 0.25rem solid #fff;
border-radius: 0.25rem;
box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.25);
height: 50px;
overflow: hidden;
position: absolute;
top: 50%; /* Set the top position to 50% */
left: 50%; /* Set the left position to 50% */
transform: translate(-50%, -50%); /* Move the element to the center using transform */
z-index: 1; /* Set a higher z-index than qrcode_code element */
}
.qrcode_code{
background-color: #fff;
border: 0.25rem solid #fff;
border-radius: 0.25rem;
box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.25);
width: auto;
position: relative; /* Set the position to relative */
z-index: 0;
}
</style>
