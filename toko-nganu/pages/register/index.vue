<template>
  <div>
    <div class="bar">
      <div class="contact white--text">
        <div class="contact-text font-weight-regular">+62-000-000-000</div>
      </div>
    </div>
    <div class="home-container">
      <v-row>
        <v-col cols="1">
          <div class="">
            <v-img :src="require('~/assets/logo.png')" width="100px"></v-img>
          </div>
        </v-col>
        <v-col>
          <div class="store-name f24sb">
            <div>Toko Nganu</div>
          </div>
        </v-col>
        <v-col>
          <!-- <v-text-field class="search" rounded  placeholder="Search nganu" append-icon="mdi-magnify"></v-text-field> -->
          <!-- <input type="text" class="search" placeholder="Search nganu"> -->
        </v-col>
      </v-row>
      <center>
        <div class="card">
          <v-card
            class="mx-auto"
            max-width="400"
            max-height="950"
            variant="outlined"
            style="margin-top: 17px"
          >
            <v-card-item>
              <div>
                <div class="judul" style="font-weight: 700; font-size: 40px">
                  Buat Akun
                </div>
                <v-sheet width="300" class="mx-auto">
                  <!-- <v-form fast-fail @submit.prevent> -->
                  <v-text-field
                    v-model="dataregist.nama"
                    label="Nama"
                    :rules="namaRules"
                  ></v-text-field>
                  <v-text-field
                    v-model="dataregist.email"
                    label="E-mail"
                    :rules="emailRules"
                  ></v-text-field>

                  <v-text-field
                    v-model="dataregist.password"
                    label="Password"
                    :rules="passwordRules"
                    type="password"
                  ></v-text-field>
                  <v-text-field
                    v-model="dataregist.salt_password"
                    label="Password"
                    :rules="passwordRules"
                    type="password"
                  ></v-text-field>

                  <v-btn
                    type="submit"
                    block
                    class="mt-2 white--text"
                    style="
                      border-radius: 50px;
                      margin-top: 30px;
                      margin-bottom: 20px;
                      background-color: #2f432d;
                    "
                    >Buat Akun</v-btn
                  >
                  <div class="login" style="padding-bottom: 20px">
                    Sudah punya akun?
                    <a href="#">Login</a>
                  </div>
                  <!-- </v-form> -->
                </v-sheet>
              </div>
            </v-card-item>
          </v-card>
        </div>
      </center>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data: () => ({
    dataregist: {
      nama: "",
      email: "",
      password: "",
      salt_password: "",
    },
    namaRules: [
      (value) => {
        if (value?.length > 0) return true;

        return "Nama tidak boleh kosong";
      },
    ],
    emailRules: [
      (value) => {
        if (value?.length > 0) return true;

        return "E-mail tidak boleh kosong";
      },
    ],
    passwordRules: [
      (value) => {
        if (value?.length > 0) return true;

        return "Password tidak boleh kosong";
      },
    ],
  }),
  methods: {
    register() {
      axios
        .post("http://127.0.0.1:8000/registrasi", this.dataregist)
        .then((respon) => {
          this.data = respon.data;
        });
    },
  },
};
</script>
<style>
.contact {
  background-color: #2f432d;
  padding: 5px 0px 7px 154px;
}
.home-container {
  padding: 0px 123px;
}
.card {
  font-family: "Poppins", sans-serif;
}
.f24sb {
  padding-top: 15px;
  font-weight: 600;
  font-size: 24px;
  line-height: 36px;
}
</style>
