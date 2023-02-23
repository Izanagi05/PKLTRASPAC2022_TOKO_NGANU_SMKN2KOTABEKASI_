<template>
  <div>
    <Navbar />
    <div class="home-container">
      <div class="content">
        <div class="kiri">
          <div class="sub-title" style="margin-left: 27px, margin-right=36px">
            Profil Pengguna
          </div>
          <div class="menu">
            <NuxtLink to="/" class="my-link" tag="v-button">
              <v-icon large>mdi-account</v-icon> Info User
            </NuxtLink>
            <NuxtLink to="/" class="my-link" tag="v-button">
              <v-icon large>mdi-account-tie</v-icon> Admin
            </NuxtLink>
            <NuxtLink to="/toko-user" class="my-link">
              <v-icon large>mdi-eye</v-icon> Toko
            </NuxtLink>
            <NuxtLink to="/user-view/tambah-toko" class="my-link">
              <v-icon large></v-icon> Buka Toko
            </NuxtLink>
            <NuxtLink to="/user-view/tambah-barang" class="my-link">
              <v-icon large></v-icon> tambah barang
            </NuxtLink>
          </div>
          <div class="logout" style="margin-left: 27px">
            <v-btn text @click="logout()" class="mdi-35px"
              ><v-icon>mdi-logout</v-icon>Logout</v-btn
            >
          </div>
        </div>
        <div class="pembatas"></div>
        <div class="profil">
          <div class="navigasi">
            <NuxtLink to="/" class="my-link" tag="v-button"> Home </NuxtLink
            ><span class="mdi mdi-chevron-right"><b>Profil Pengguna</b></span>
          </div>
          <v-row class="isi">
            <v-col>
              <div class="foto-profil">
                <v-avatar width="270px" height="270px">
                  <v-img :src="require('~/assets/barang.png')"></v-img>
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
                  <p>Alamat</p>
                </v-col>
                <v-col cols="12" sm="6">
                  <p>MasBro</p>
                  <p>Nyatir</p>
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
                  <p>+62-8126365467</p>
                  <p>masbronyatir@gmail.com</p>
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
export default {
  middleware: "middlewareku",

  methods: {
    logout() {
      this.$store.dispatch("users/logout");
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
  margin-top: 69px;
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
</style>
