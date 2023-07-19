<template>
  <ion-page>
    <ion-content :fullscreen="true" class="settings-main">
      <h2 class="tittle">Nastavitve</h2>
      <div class="settings">
        <div class="personal">
          <h2>Osebni podatki</h2>
          <ion-item id="name">
            <p @click="copyToClipboard(userData.name)">
              Ime: {{ userData.name }}
            </p>
          </ion-item>
          <ion-item id="surrname">
            <p @click="copyToClipboard(userData.surname)">
              Priimek: {{ userData.surname }}
            </p>
          </ion-item>
          <ion-item id="email">
            <p @click="copyToClipboard(userData.email)">
              E-pošta: {{ userData.email }}
            </p>
          </ion-item>
        </div>
        <div class="app">
          <h2>Prijavni podatki</h2>
          <ion-item id="username">
            <p @click="copyToClipboard(userData.username)">
              Uporabniško ime: {{ userData.username }}
            </p>
          </ion-item>
          <ion-item>
            <ion-button @click="changePassword()">Spremeni geslo</ion-button>
          </ion-item>
          <ion-item>
            <ion-button color="#cacaca" @click="deleteUser"
              >Izbirši uporabniški račun</ion-button
            >
          </ion-item>
        </div>
      </div>
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
import { defineComponent } from "vue";
import { toastController } from "@ionic/core";
import { alertController } from "@ionic/vue";
import axios from "axios";

interface User {
  name: string;
  surname: string;
  email: string;
  username: string;
}

export default defineComponent({
  data() {
    return {
      userData: {} as User,
      token: localStorage.getItem("awtToken"),
    };
  },
  created() {
    axios
      .post(
        "https://e-dentiteta.usdd.company/APIs/user.php",
        {},
        {
          headers: {
            authorization: `Bearer ${this.token}`,
          },
        }
      )
      .then((response) => {
        if(response.data == "token"){
          localStorage.removeItem("awtToken");
          (this as any).$router.push({ path: "/login" });
        }
        console.log(response.data);
        this.userData = {
          name: response.data[0].name,
          surname: response.data[0].surname,
          email: response.data[0].email,
          username: response.data[0].username,
        };
        console.log(this.userData);
      })
      .catch((error) => {
        console.error(error);
      });
  },
  methods: {
    async copyToClipboard(text: string) {
      const input = document.createElement("input");
      input.setAttribute("value", text);
      document.body.appendChild(input);
      input.select();
      document.execCommand("copy");
      document.body.removeChild(input);
      const toast = await toastController.create({
        message: "Kopirano v odložišče",
        duration: 1500,
        position: "bottom",
      });

      toast.present();
    },
    async changePassword() {
      (this as any).$router.push({ path: "change-password" });
    },
    async deleteUser() {
      const alert = await alertController.create({
        header: "Izbris uporabniškega računa",
        message:
          "Ali ste prepričani, da želite izbrisati vaš uporabniški račun?",
        buttons: [
          {
            text: "Prekliči",
            role: "cancel",
            cssClass: "secondary",
          },
          {
            text: "Izbriši",
            handler: () => {
              this.deleteAcc("true");
            },
          },
        ],
      });
      await alert.present();
    },
    async deleteAcc(x: any) {
      if (x === "true") {
        const token = localStorage.getItem("awtToken");
        const formData = new FormData();
        formData.append("delete ", "true");
        axios.post(
          "https://e-dentiteta.usdd.company/APIs/delete_acc.php",
          formData,
          {
            headers: {
              authorization: `Bearer ${token}`,
            },
          }
        );

        localStorage.removeItem("awtToken");
        (this as any).$router.push({ path: "/login" });
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

.settings {
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
  align-items: center;
  width: 90%;
  height: 80%;
  margin-left: 0;
  background-color: #3587c3;
  color: black;
  border-radius: 10px;
  margin-right: 5%;
  margin-left: 5%;
}

.settings .personal {
  width: 90%;
  margin-left: auto;
  margin-right: auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: left;
  color: black;
}
.settings .app {
  width: 90%;
  margin-left: auto;
  margin-right: auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: left;
}

.settings .app h2,
.settings .personal h2 {
  margin-left: 5px;
  color: white;
}

.settings .personal p,
.settings .app p {
  color: white;
}

.settings-main {
  display: flex;
  flex-direction: column;
}
.settings-main .tittle {
  margin-right: auto;
  margin-left: auto;
  font-weight: 600;
  font-size: 2rem;
  margin-left: 5px;
  margin-top: 5%;
  color: black;
}
</style>
