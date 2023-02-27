<template>
  <div>
    <NavbarPolos />
    <div class="home-container">
      <center>
        <div class="card">
          <v-card
            class="mx-auto"
            max-width="400"
            max-height="950"
            variant="outlined"
            style="margin-top: 17px"
          >
            <v-card>
              <div>
                <div class="judul" style="font-weight: 700; font-size: 40px">
                  Buat Akun
                </div>
                <v-sheet width="300" class="mx-auto">
                  <v-form fast-fail @submit.prevent="registrasi">
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
                      <NuxtLink to="/login" class="my-link"> Login </NuxtLink>
                    </div>
                  </v-form>
                </v-sheet>
              </div>
            </v-card>
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
    registrasi() {
      axios
        .post("http://127.0.0.1:8000/api/registrasi", this.dataregist)
        .then((respon) => {
          this.data = respon.data;
          window.location.replace('/')
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
