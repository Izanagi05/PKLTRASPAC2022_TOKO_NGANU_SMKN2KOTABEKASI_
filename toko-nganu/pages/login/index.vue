<template>
  <div>
    <NavbarPolos />
    <div class="home-container">
      <div class="card">
        <center>
          <v-card
            flat
            class="mx-auto"
            max-width="400"
            max-height="950"
            variant="outlined"
            style="margin-top: 100px"
          >
            <v-card flat>
              <div>
                <div class="judul" style="font-weight: 700; font-size: 40px">
                  Login
                </div>

                <v-sheet width="300" class="mx-auto">
                  <v-form fast-fail @submit.prevent="loginuser()">
                    <v-text-field
                      v-model="email"
                      label="E-mail"
                      :rules="emailRules"
                    ></v-text-field>

                    <v-text-field
                      v-model="password"
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
                    >
                      Login
                    </v-btn>
                    <div class="buat-akun" style="padding-bottom: 20px">
                      Belum punya akun?
                      <nuxt-link to="/register" class="my-link">
                        Buat Akun
                      </nuxt-link>
                    </div>
                  </v-form>
                </v-sheet>
              </div>
            </v-card>
          </v-card>
        </center>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import NavbarPolos from "~/components/NavbarPolos.vue";
export default {
  middleware: ["middlewareku", "middlewarelogin"],
  data: () => ({
    email: null,
    ket: null,
    no_telepon: null,
    tes: null,
    dtk: null,
    dtr: null,
    password: null,
    cekketusr: null,

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
    loginuser() {
      this.tes = this.userdata;
      if (
        this.username === null ||
        this.username === "" ||
        this.password === null ||
        this.password === ""
      ) {
        this.$toast.error("Username dan Password harus sesuai");
      } else {
        axios
          .post("http://127.0.0.1:8000/api/login", {
            email: this.email,
            password: this.password,
          })
          .then((respon) => {
            this.ket = respon.data
            this.cekketusr = respon.data.message;


            this.$store.dispatch("users/logincekuser", this.cekketusr);
            if( this.cekketusr === "login gagal"){
              this.$store.dispatch("users/resetlogincekuser");
              alert('Isi email atau password dengan benar')
            }else{
              this.$toast.success("Login berhasil");
              this.$store.dispatch("users/resetlogincekuser");
              this.$store.dispatch("users/login", this.ket);
            }
          });
      }
    },
  },


  components: { NavbarPolos },
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
