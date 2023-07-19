<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Dodaj kartico</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Dodaj vrsto kartico</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-card>
        <ion-card-header>
          <ion-card-title>Dodaj kartico</ion-card-title>
        </ion-card-header>
        <ion-card-content>
          <ion-list>
            <ion-item>
              <ion-input type="text" placeholder="Vpišite polno ime kartice" v-model="imekartice"></ion-input>
            </ion-item>
            <ion-item>
              <input class="upload"
                type="file"
                accept="image/*"
                required
                ref="file"
                @change="onFileChange"
                style="color: #999999;"
              />
              
            </ion-item>
            <ion-item>
              <ion-button expand="block" @click="uploadCard" color="#cacaca"
                >Dodaj vrsto kartice</ion-button
              >
            </ion-item>
          </ion-list>
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
  IonSelect,
  IonSelectOption,
} from "@ionic/vue";
</script>
<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";
import { alertController } from "@ionic/vue";

interface Cards {
  tip: string;
  value: string;
}

export default defineComponent({
  data() {
    return {
      imekartice: "",
      file: "",
      showDismissibleAlert: false,
      link: "https://e-checker.usdd.company/APIs/",
    };
  },
  methods: {
    onFileChange(event: any) {
      this.file = (this as any).$refs.file.files[0];
    },
    async uploadCard() {
      if(this.imekartice!="" && this.file!=""){
        const formData = new FormData();
        formData.append("img", this.file);
        formData.append("name", this.imekartice);
        const token = localStorage.getItem("awtToken");
        const response = await axios.post(this.link + "addTypeOfCard.php", formData, {
          headers:{
            authorization: `Bearer ${token}`,
          }
        })
        if (response.data == "File uploaded successfully"){
          const alert = await alertController.create({
                header: "OK",
                message: "Kartica je bila uspešno naložena",
                buttons: ["V redu"],
                cssClass: "alert-text-color",
              });
              await alert.present();
        }
        else if(response.data == "token"){
          localStorage.removeItem("awtToken");
          (this as any).$router.push({ path: "/login" });
        }
      }
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
.upload::-webkit-file-upload-button{
  text-transform: none;
  font-size: 2vh;
  border-radius: 50px;
  border-style: none;
  --box-shadow: none !important;
  height: 3vh;
  outline: 0px soild transparent;
  color: #fdfbfb;
  background-color: #999999;
}
.upload::-webkit-file-upload-button:active{
  background-color: #828282;
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
#alert-3-msg,
.alert-title.sc-ion-alert-md,
.alert-button.sc-ion-alert-ios,
.alert-button.sc-ion-alert-md,
.alert-message.sc-ion-alert-md,
.alert-input-group.sc-ion-alert-md {
  color: #111111;
}
.alert-wrapper.sc-ion-alert-ios,
.alert-wrapper.sc-ion-alert-md {
  background-color: #999999;
  color: #111111;
}
.alert-message.sc-ion-alert-md,
.alert-input-group.sc-ion-alert-md {
  color: var(--ion-color-step-550, #111111);
}
.alert-text-color{
  color: #111111;
}
.alert-text-color .alert-message{
  color: #111111;
  background-color: #999999;
}
</style>
