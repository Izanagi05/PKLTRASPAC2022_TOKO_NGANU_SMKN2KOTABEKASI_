<template>
  <div>
    <Navbar />
    <div class="home-container">
      <div class="content">
        <div class="profil">
          <div class="navigasi">
            <NuxtLink to="/" class="my-2 text-decoration-none black--text">
              Home </NuxtLink
            ><span class="mdi mdi-chevron-right"><b>Profil Pengguna</b></span>
          </div>
          <v-row class="isi">
            <v-col>
              <div class="foto-profil">
                <v-avatar class="foto-profilan" width="270px" height="270px">
                  <!-- {{ dataprofil.foto_profil }} -->
                  <img
                    v-if="fotoProfil"
                    :src="'http://127.0.0.1:8000/storage/' + fotoProfil"
                  />
                  <img v-else src="~/assets/dingin_coy.png" />
                </v-avatar>
              </div>
              <div class="btn-card pl-1 pb-1">
                <v-btn
                  class="profil-btn font-weight-medium"
                  width="310px"
                  style="font-size: 24px; font-family: Poppins, sans-serif"
                  outlined
                  rounded
                  height="40px"
                  @click="pushprofil"
                >
                  Edit Profil
                </v-btn>
              </div>
            </v-col>
            <v-col>
              <v-row dense justify="center">
                <v-col cols="12">
                  <div class="informasi-judul">Info Pengguna</div>
                </v-col>
              </v-row>

              <v-row dense justify="center">
                <v-col cols="12" sm="6">
                  <p>Nama</p>
                  <!-- <p>Alamat</p> -->
                </v-col>
                <v-col cols="12" sm="6">
                  <p>{{ dataprofil.nama }}</p>
                </v-col>
              </v-row>
              <v-row dense justify="center">
                <v-col cols="12">
                  <div class="informasi-judul">Info Kontak</div>
                </v-col>
              </v-row>

              <v-row dense justify="center">
                <v-col cols="12" sm="6">
                  <p>Telepon</p>
                  <p>Email</p>
                </v-col>
                <v-col cols="12" sm="6">
                  <p>{{ dataprofil.no_telepon }}</p>
                  <p>{{ dataprofil.email }}</p>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  // layout: "UserView",
  middleware: "middlewareku",
  data() {
    return {
      dataprofil: {
        nama: null,
        no_telepon: null,
        email: null,
      },
      cekuserrole: null,
      userid: null,
    };
  },

  methods: {
    getuser() {
      axios
        .get("http://127.0.0.1:8000/api/getuserlogin/" + this.userid)
        .then((respon) => {
          this.dataprofil = respon.data;
        });
    },
    logout() {
      this.$store.dispatch("users/logout");
    },
    pushprofil() {
      this.$router.push("/user-view/edit-profil");
    },
  },

  created() {
    const usid = this.$cookies.get("cookieku");
    this.userid = usid.data.id;
    this.getuser();
    this.cekuserrole = usid.role;
  },
  mounted() {
    this.getuser();
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
.content {
  display: flex;
  gap: 38px;
}
.sub-title {
  font-family: "Poppins", sans-serif;
  font-weight: 700;
  font-size: 24px;
}
.menu {
  display: grid;
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-size: 20px;
  /* margin-top: 69px; */
}
.logout {
  margin-top: 120px;
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-size: 20px;
}
.pembatas {
  border-left: 8px solid #d9d9d9;
  border-radius: 20px;
  height: 450px;
  margin-right: 10px;
}
.profil-btn {
  height: 30px;
  width: 114px;
}
.profil-btn:hover {
  background: #2f432d;
  color: rgb(255, 255, 255);
}
.kiri {
  margin-top: 19px;
}
.my-link {
  text-decoration: none;
  color: #000000;
  margin-bottom: 43px;
}
.isi {
  margin-top: 26px;
}
.btn-card {
  margin-top: 30px;
}
.informasi-judul {
  font-family: Poppins;
  font-weight: 700;
  font-size: 20px;
}
.foto-profilan {
  background: #d9d9d9;
}
</style>
