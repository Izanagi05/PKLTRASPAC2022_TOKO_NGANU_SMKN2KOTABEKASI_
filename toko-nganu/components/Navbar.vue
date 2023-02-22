<template>
  <div class="ppp">
    <div class="contact white--text">
      <div class="contact-text font-weight-regular">
        <div class="icon_telepon">
          <v-img :src="require('~/assets/telepon.png')"></v-img>
        </div>
        <div>+62-000-000-000</div>
      </div>
    </div>
    <div class="nav">
      <div class="logo">
        <v-img :src="require('~/assets/logo_nganu.png')" width="100px"></v-img>
      </div>
      <div class="nama_toko">
        <div>Toko Nganu</div>
      </div>
      <v-card flat class="rounded-pill" color="#d9d9d9">
        <v-text-field
          class="nyari rounded-pill"
          v-model="cari"
          label="Cari Nganu"
          single-line
          hide-details
          outlined
          append-icon="mdi-magnify"
          placehoder="Ni ai wo wo ai ni mi xue bing cheng tianmi mi ni ai wo wo ai ni"
        ></v-text-field>
        <!-- <v-img
          :src="require('~/assets/search_icon.png')"
          class="icon_search"
        ></v-img> -->
      </v-card>
      <div class="profile_icon_keranjang">
        <button class="round-btn">
          <v-img
            :src="require('~/assets/keranjang_icon.png')"
            width="38"
            class="keranjang"
          ></v-img>
        </button>
        <button class="round-btn">
          <v-img
            :src="require('~/assets/dingin_coy.png')"
            width="49"
            class="user_foto"
          ></v-img>
        </button>
        <div class="namanya">Mas BroNyatirrrrrrrrrrrr</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.ppp {
  overflow: hidden;
  margin-bottom: 51px;
  font-family: "Poppins", sans-serif;
}
.contact {
  background: #2f432d;
  padding: 9px 123px 10px 123px;
}
.search-class {
  display: flex;
  border-radius: 24px;
  width: 268px;
  height: 49px;
  background-color: #d9d9d9;
  margin-left: 500px;
}
.search-class .nyari {
  width: 183px;
}
.search-class .icon_search {
  width: 38px;
  height: 38px;
}
.round-btn {
  border-radius: 50%;
  width: 49px;
  height: 49px;
  background-color: #d9d9d9;
}
.contact-text {
  display: flex;
  font-size: 16px;
  line-height: 24px;
}
.contact-text .icon_telepon {
  margin-right: 11px;
  margin-top: 3px;
}
.nav {
  padding: 39px 123px 10px 123px;
  display: flex;
}
.logo {
  width: 43px;
  height: auto;
}
.nama_toko {
  margin-top: 4px;
  margin-left: 33px;
  font-size: 24px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
}
.namanya {
  display: inline-block;
  width: 100px;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
  margin-top: 11px;
  margin-left: 12px;
  font-size: 20px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
}
.profile_icon_keranjang {
  display: flex;
  gap: 11px;
  margin-left: 32px;
}
.keranjang {
  margin-left: 5px;
}
</style>