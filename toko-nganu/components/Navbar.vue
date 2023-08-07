<template>
  <div class="ppp">
    <div class="contact white--text">
      <div class="contact-text font-weight-regular">
        <button class="kontak" type="submit" @click="kontak">
          <v-icon color="white">mdi-phone</v-icon>
          +62-815-6315-1038
        </button>
      </div>
    </div>

    <div class="container">
      <v-row>
        <v-col class="d-flex col-12 col-lg-6 col-md-4  col-sm-12 col-xs-12">

          <div class="logo">
            <v-img :src="require('~/assets/logo_nganu.png')" width="100px"></v-img>
          </div>
          <div class="nama_toko">
            <div>Toko nganu</div>
          </div>
        </v-col>

        <!-- <div flat class="rounded-pill search" color="#d9d9d9"></div> -->
        <v-col class="d-flex col-12 col-lg-6 col-md-4  col-sm-12 col-xs-12 justify-end justify-lg-end justify-md-end justify-sm-start">
          <div class="profile_icon_keranjang">
            <nuxt-link to="/keranjang" class="text-decoration-none">
              <v-btn elevation="2" fab color="d9d9d9" icon
              ><v-icon size="29px">mdi-cart</v-icon></v-btn
          >
        </nuxt-link>
        <nuxt-link to="/user-view" class="text-decoration-none">
          <v-btn elevation="1" fab icon color="d9d9d9">
            <v-avatar class="foto-profilan">
              <img
                :src="
                  'http://127.0.0.1:8000/storage/' +
                  $cookies.get(`cookieku`).data.foto_profil
                "
              />
            </v-avatar>
          </v-btn>
        </nuxt-link>
        <div class="display-5 my-auto ml-2 font-weight-bold text-truncate">{{ $cookies.get("cookieku").data.nama }}</div>
      </div>
    </v-col>
    </v-row>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      dataprofil: {
        nama: null,
        no_telepon: null,
        email: null,
        foto_profil: "",
      },
      // foto_profil: "",
      cekuserrole: null,
      userid: null,
      editprofil: [],
      cari: null,
      nama: "tes",
      no_admin: "6281563151038",
    };
  },
  methods: {
    kontak() {
      let nomer = this.no_admin;
      window.open("https://wa.me/" + nomer);
    },
    getuserlogin() {
      axios
        .get("http://127.0.0.1:8000/api/getuserlogin/" + this.userid)
        .then((respon) => {
          this.editprofil = respon.data;
        });
    },
    pushprofil() {
      this.$router.push("/user-view/edit-profil");
    },
  },
  created() {
    this.getuserlogin();
  },
};
</script>

<style>
.ppp {
  margin-bottom: 51px;
  font-family: "Poppins", sans-serif;
}
.contact {
  background: #2f432d;
  padding: 9px 123px 10px 123px;
}
.search {
  margin-left: 900px;
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
  margin-top: 14px;
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
