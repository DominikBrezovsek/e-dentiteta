<template>
  <ion-page>
    <ion-content :fullscreen="true" class="login_background">
      <ion-header collapse="condense">
      </ion-header>
      <div class="login">
        <div class="login_form">
          <p>Prijava</p>
          <ion-input v-model="username" class="login_input" type="text" placeholder="Vnesite uporabniško ime" required/>
          <ion-input v-model="password" class="login_input" type="password" placeholder="Vnesite geslo" required/>
          <button class="login_button" @click="login()">Prijava</button>
        </div>
      </div>
    </ion-content>
  </ion-page>
</template>
<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";
import { alertController } from "@ionic/vue";

export default defineComponent({
  data() {
    return {
      username: "",
      password: "",
      showDismissibleAlert: false,
    };
  },
  methods: {
    async login() {
      if (this.username != "" && this.password != "") {
        const awtToken = localStorage.getItem("awtToken");
        const formData = new FormData();
        formData.append("username", this.username);
        formData.append("password", this.password);
        if(awtToken != null){
          //Check if you have in localStorage remember me then post just localStorage
          formData.append("awtToken", awtToken);
        }
        
        const response = await axios
          .post("https://e-dentiteta.usdd.company/APIs/login.php", formData);
        if (response.data.success == "true") {
          this.username = "";
          this.password = "";
          localStorage.setItem("awtToken", response.data.jwt);
          (this as any).$router.push({ path: "/home/home" });
        }
        else if (response.data === "Invalid credentials.") {
          const alert = await alertController.create({
            header: "Nepravilni podatki",
            message: "Vnešeni podatki niso pravilni",
            buttons: ["V redu"],
          });
          await alert.present();
        }
        

      }
      else {
        const alert = await alertController.create({
          header: "Manjkajoči podatki",
          message: "Prosimo, izpolnite vsa polja.",
          buttons: ["V redu"],
        });
        await alert.present();
      }

    },
  },
});
</script>
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
<style>
.login {
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
  align-items: center;
  height: 100%;
  width: 100%;
  background-image: url("https://e-dentiteta.usdd.company/images/background-custom.png");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: top;
}


.login h4 {
  color: black;
  font-size: 2vh;
  margin-bottom: 2vh;
}

.login p {
  color: black;
  font-size: 2.5vh;
  font-weight: 700;
  margin-bottom: 2vh;
  text-align: left;
  margin-right: auto;
  text-transform: uppercase;
}

.login_form {
  display: flex;
  position: fixed;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 45%;
  margin-top: 35%;
  margin-bottom: 27.5%;
  width: 80%;
  padding: 2vh;
  background-color: rgba(200, 225, 238, 0.53);
  backdrop-filter: blur(5px);
  color: black;
  border-radius: 20px;
  padding: 4vh 1vh;
}

.login_form .login_input {
  width: 100%;
  margin-bottom: 2vh;
  color: black;
  font-size: 2vh;
  font-weight: 600;
  background-color: transparent;
  border-bottom: 2px solid black;
}

.login_input::placeholder {
  color: black;
  font-size: 2vh;
  font-weight: 600;
}

.login_form .login_input:active{
  box-shadow: 2px, 2px, 2px, 2px, rgba(0, 0, 0, 0.5);
  border-bottom: 1px solid linear-gradient(133deg, rgba(6,32,50,1) 0%, rgba(21,107,161,1) 27%, rgba(0,212,255,1) 100%);
  transition: ease-in 0.2s;
}

.login_form .login_button {
  margin-bottom: 2vh;
  text-transform: none;
  font-size: 2vh;
  width: 30%;
  height: 5vh;
  padding: 5px 5px;
  font-weight: 600;
  background: linear-gradient(213deg,#7aaac8,#51b1ff);
  border-radius: 20px;
  margin-right: auto;
  color: white;
  text-transform: uppercase;
}
</style>
