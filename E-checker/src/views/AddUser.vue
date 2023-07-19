<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Dodajanje uporabnika storitvi E-dentiteta</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large"
            >Dodajanje uporabnika storitvi E-dentiteta</ion-title
          >
        </ion-toolbar>
      </ion-header>
      <ion-card>
        <ion-card-header>
          <ion-card-title>Informacije za registracijo</ion-card-title>
        </ion-card-header>
        <ion-card-content>
          <ion-card>
            <ion-card-header>
              <ion-card-title>Osebni podatki uporabnika</ion-card-title>
            </ion-card-header>
            <ion-card-content>
              <ion-list>
                <ion-item>
                  <ion-input
                    v-model="name"
                    type="text"
                    placeholder="Vnesite ime"
                    required
                  ></ion-input>
                </ion-item>
                <ion-item>
                  <ion-input
                    v-model="surname"
                    type="text"
                    placeholder="Vnesite priimek"
                    required
                  ></ion-input>
                </ion-item>
                <ion-item>
                  <ion-input
                    v-model="email"
                    type="email"
                    placeholder="Vnesite e-pošto"
                    required
                  ></ion-input>
                </ion-item>
              </ion-list>
            </ion-card-content>
          </ion-card>
          <ion-button fill="solid" @click="register()" color="#cacaca"
            >Registriraj uporabnika</ion-button
          >
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
import { defineComponent } from "vue";
import { alertController } from "@ionic/vue";
import axios from "axios";

export default defineComponent({
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
    async register() {
      if (this.name != "" && this.surname != "" && this.email != "") {
        const emailpattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
        if (emailpattern.test(this.email)) {
          try {
            const formData = new FormData();
            const token = localStorage.getItem("awtToken");
            formData.append(
              "name",
              this.name.charAt(0).toUpperCase() +
                this.name.slice(1).toLocaleLowerCase()
            );
            formData.append(
              "surname",
              this.surname.charAt(0).toUpperCase() +
                this.surname.slice(1).toLocaleLowerCase()
            );
            formData.append("email", this.email);
            const data = await axios.post(
              this.link + "register.php ",
              formData,
              {
                headers: {
                  authorization: `Bearer ${token}`,
                },
              }
            );
            console.log(data);
            if (data.data == "Email already in use.") {
              this.email = "";
              const alert = await alertController.create({
                header: "Napaka",
                subHeader: "E-pošta",
                message: "Uporabnik pod to e-pošto že obstaja",
                cssClass: "alert-text-color",
                buttons: ["V redu"],
              });
              await alert.present();
            } else if (data.data == "true") {
              this.name = "";
              this.surname = "";
              this.email = "";
              const alert = await alertController.create({
                header: "Uspešno",
                subHeader: "Kreacija uporabnika",
                cssClass: "alert-text-color",
                message:
                  "Uporabnik je bil kreiran. Uporabnik bo v kratkem prejel e-pošto, kjer si bo lahko nastavil geslo.",
                buttons: ["V redu"],
              });
              await alert.present();
            } else if (data.data == "token") {
              localStorage.removeItem("awtToken");
              (this as any).$router.push({ path: "/login" });
            }
          } catch (error) {
            console.error(error);
          }
        } else {
          const alert = await alertController.create({
            header: "Napaka",
            subHeader: "Vnos e-pošte",
            message: "Prosimo vnesite pravilno epošto",
            cssClass: "alert-text-color",
            buttons: ["V redu"],
          });
          await alert.present();
        }
      } else {
        const alert = await alertController.create({
          header: "Napaka",
          subHeader: "Vnos vseh podatkov",
          message: "Prosimo vnesite vse podatke",
          cssClass: "alert-text-color",
          buttons: ["V redu"],
        });
        await alert.present();
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
ion-searchbar {
  background-color: antiquewhite;
}
ion-radio-group {
  display: flex;
  flex-wrap: wrap;
  max-height: 200px;
  max-width: 400px;
}
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
  margin-top: 5%;
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
  background-color: white;
  padding: 2px;
}
.home_card ion-card-title {
  right: 5%;
  text-transform: uppercase;
}
ion-card {
  justify-content: center;
  background-color: #fdfbfb;
  outline: 3px solid #fdfbfb;
  color: #111111;
}
ion-button,
.button-solid {
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
h3 {
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
.alert-text-color {
  color: #111111;
}
.alert-text-color .alert-message {
  color: #111111;
  background-color: #999999;
}
</style>
