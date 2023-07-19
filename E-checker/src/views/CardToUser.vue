<template>
  <ion-page>
    <ion-header class="bckground">
      <ion-toolbar>
        <ion-title>Dodaj kartico</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Dodaj kartico uporabniku</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-card class="card">
        <ion-card-header>
          <ion-card-title class="select"
            >Dodaj kartico uporabniku</ion-card-title
          >
        </ion-card-header>
        <ion-card-content>
          <ion-list>
            <ion-item>
              <ion-select
                interface="popover"
                placeholder="Izberite tip kartice"
                v-model="tip"
                required
                class="select"
              >
                <ion-select-option
                  v-for="item in cards"
                  :key="item.tip"
                  :value="item.tip"
                  class="select"
                >
                  {{ item.tip }}
                </ion-select-option>
              </ion-select>
            </ion-item>
            <ion-item>
              <ion-input
                v-model="searchTerm"
                @ionChange="filterUsers"
                @ionInput="search"
                placeholder="Poiščite uporabnika (vnesite vsaj 5 znakov)"
                class="select"
              ></ion-input>
            </ion-item>
            <!--  <ion-item>
              <ion-button @click="search" color="#cacaca"
                >Poišči uporabnika (vnesite vsaj 3 znake)</ion-button
              >
            </ion-item> -->
            <ion-item>
              <ion-select
                interface="popover"
                placeholder="Izberite uporabnika"
                v-model="selectedUser"
                required
                class="select"
              >
                <ion-select-option
                  v-for="user in users"
                  :key="user.user"
                  :value="user.user"
                  class="select"
                >
                  {{ user.user }}
                </ion-select-option>
              </ion-select>
            </ion-item>
          </ion-list>
        </ion-card-content>
      </ion-card>
      <br />
      <ion-card class="card">
        <ion-card-header>
          <ion-card-title class="select"
            >Datum veljavnosti kartice</ion-card-title
          >
        </ion-card-header>
        <ion-card-content>
          <ion-list>
            <ion-item>
              <ion-input
                v-model="year"
                type="text"
                placeholder="Vnesite leto poteka kartice YYYY"
                required
                class="select"
              ></ion-input>
            </ion-item>
            <ion-item>
              <ion-input
                v-model="month"
                type="text"
                placeholder="Vnesite mesec poteka kartice MM"
                required
                class="select"
              ></ion-input>
            </ion-item>
            <ion-item>
              <ion-input
                v-model="day"
                type="text"
                placeholder="Vnesite dan poteka kartice DD"
                required
                class="select"
              ></ion-input>
            </ion-item>
          </ion-list>
          <ion-item>
            <ion-button
              class="select btn"
              color="#cacaca"
              expand="block"
              @click="uploadCard"
              >Dodaj uporabnika s kartico</ion-button
            >
          </ion-item>
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
  IonRadio,
  IonRadioGroup,
  IonLabel,
  IonListHeader,
} from "@ionic/vue";
</script>
<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";
import { alertController } from "@ionic/vue";
interface Cards {
  tip: string;
  image: string;
}
interface Users {
  user: string;
}

export default defineComponent({
  data() {
    return {
      tip: "",
      DOE: "",
      year: "",
      month: "",
      day: "",
      username: "",
      selectedUser: "",
      link: "https://e-checker.usdd.company/APIs/",
      cards: [] as Cards[],
      users: [] as Users[],
      Filterdusers: [] as Users[],
      searchTerm: "",
    };
  },
  created() {
    const token = localStorage.getItem("awtToken");
    axios
      .post(this.link + "cards.php", "", {
        headers: {
          authorization: `Bearer ${token}`,
        },
      })
      .then((response) => {
        if (response.data == "token") {
          localStorage.removeItem("awtToken");
          (this as any).$router.push({ path: "/login" });
        }
        console.log(response.data);
        // Extract the array of card objects from the response object
        const cardArray = response.data.object;
        // Map over the array of card objects
        this.cards = cardArray.map((item: any) => {
          return {
            tip: item.tip,
            image: item.image,
          };
        });
        console.log(this.cards);
      })
      .catch((error) => {
        console.error(error);
      });
  },
  methods: {
    async uploadCard() {
      if (
        this.year.length == 4 &&
        (this.month.length == 1 || this.month.length == 2) &&
        (this.day.length == 1 || this.day.length == 2)
      ) {
        if (this.month.length == 1) {
          this.month = "0" + this.month;
        }
        if (this.day.length == 1) {
          this.day = "0" + this.day;
        }
        this.DOE = this.year + "-" + this.month + "-" + this.day;
      } else {
        const alert = await alertController.create({
          header: "Napaka",
          subHeader: "Izpolnjevanje datuma poteka",
          message: "Prosimo vnesit podatke v pravilni obliki",
          buttons: ["V redu"],
          cssClass: "alert-text-color",
        });
        await alert.present();
      }
      const card = this.cards.find((card) => card.tip === this.tip);
      if (
        this.DOE != "" &&
        this.tip != "" &&
        this.selectedUser != "" &&
        card != undefined
      ) {
        const formData = new FormData();
        formData.append("DOE", this.DOE);
        formData.append("type", this.tip);
        formData.append("user", this.selectedUser);
        formData.append("image", card.image);
        const token = localStorage.getItem("awtToken");
        const response = await axios.post(this.link + "addCard.php", formData, {
          headers: {
            authorization: `Bearer ${token}`,
          },
        });
        if (response.data == "true") {
          const alert = await alertController.create({
            header: "Vredu",
            message: "OK",
            buttons: ["V redu"],
            cssClass: "alert-text-color",
          });
          await alert.present();
        } else if (response.data == "token") {
          localStorage.removeItem("awtToken");
          (this as any).$router.push({ path: "/login" });
        }
      } else {
        const alert = await alertController.create({
          header: "Napaka",
          subHeader: "Neizpolnjeni podatki",
          message: "Prosimo vnesite vse podatke.",
          buttons: ["OK"],
          cssClass: "alert-text-color",
        });
        await alert.present();
      }
    },
    filterUsers() {
      // Get the search term from the input field
      if (this.Filterdusers.length > 0) {
        const searchTerm = this.searchTerm.toLowerCase().trim();
        this.users = this.Filterdusers.filter((user) => {
          return user.user.includes(searchTerm);
        });
      }
    },
    search() {
      if (this.searchTerm.length < 5) {
        return;
      } else {
        setTimeout(() => {
          const token = localStorage.getItem("awtToken");
          const formData = new FormData();
          formData.append("search", this.searchTerm);
          console.log(this.searchTerm);
          axios
            .post("https://e-checker.usdd.company/APIs/users.php", formData, {
              headers: {
                authorization: `Bearer ${token}`,
              },
            })
            .then((response) => {
              if (response.data == "token") {
                localStorage.removeItem("awtToken");
                (this as any).$router.push({ path: "/login" });
              }
              console.log(response.data);
              // Extract the array of card objects from the response object
              const cardArray = response.data.object;
              // Map over the array of card objects
              this.users = cardArray.map((item: any) => {
                return {
                  user: item.user,
                };
              });
              this.Filterdusers = this.users;
              console.log(this.users);
            })
            .catch((error) => {
              console.error(error);
            });
        }, 1000);
      }
    },
  },
});
</script>
<style>
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
