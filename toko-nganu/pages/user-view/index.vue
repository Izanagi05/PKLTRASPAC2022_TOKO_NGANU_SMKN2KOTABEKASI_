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
            <NuxtLink to="/" class="my-link">
              <v-icon large>mdi-account</v-icon> Info User
            </NuxtLink>
            <NuxtLink to="/" class="my-link">
              <v-icon large>mdi-account-tie</v-icon> Admin
            </NuxtLink>
            <NuxtLink to="/toko-user" class="my-link">
              <v-icon large>mdi-eye</v-icon> Toko
            </NuxtLink>
          </div>
          <div class="logout" style="margin-left: 27px">
            <span class="mdi mdi-logout mdi-35px">Logout</span>
          </div>
        </div>
        <div class="pembatas"></div>
        <div class="profil">
          <div class="navigasi">
            Home<span class="mdi mdi-chevron-right">Profil Pengguna</span>
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
                  style="font-size: 24px; font-family: 'Poppins', sans-serif"
                >
                  Edit Profil
                </v-btn>
              </div>
            </v-col>
            <v-col>
              <v-row>
                <div class="informasi">
                  <div class="sub-judul">Info Pengguna</div>
                  <v-col cols="6">
                    <div class="nama-user">Nama</div>
                    <div class="alamat-user">Alamat</div>
                  </v-col>
                  <div class="info-kontak">
                    <div class="sub-judul">Info Kontak</div>
                    <v-col>
                      <div class="telepon">Telepon</div>
                      <div class="email">E-mail</div>
                    </v-col>
                  </div>
                  <v-col>
                    <div class="isi">Masbro Adip</div>
                    <div class="isi">Rumah</div>
                  </v-col>
                  <v-col>
                    <div class="isi">+62-0786565</div>
                    <div class="isi">masbro@gmail.com</div>
                  </v-col>
                </div>
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
  middleware: 'middlewareku',
}
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
  border: 1px black solid;
  border-radius: 20px;
}
.profil-btn:hover {
  background: #2f432d;
  color: white;
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
</style>
