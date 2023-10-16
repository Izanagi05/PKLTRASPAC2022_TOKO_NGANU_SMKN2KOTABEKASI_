<template>
  <div :class="[$vuetify.breakpoint.mdAndUp?'m':'']">
    <!-- <div class="btn-warnaku white--text">
        <div class="py-1 font-weight-regular">
          <button class=" ml-4" type="submit" @click="kontak">
            <v-icon color="white">mdi-phone</v-icon>
            +62-815-6315-10389
          </button>
        </div>
      </div> -->
    <div class="container">
      <v-row class="my-0">
        <v-col cols="6" lg="6" md="6" class="d-flex py-0 d-flex align-center">
              <v-img :src="require('~/assets/logo_nganu.png')" :max-width="$vuetify.breakpoint.smAndDown?'20':'30'"></v-img>
              <div :class="['font-weight-bold', $vuetify.breakpoint.smAndDown?'ml-2':'ml-4 text-h6']">Toko nganu</div>
          </v-col>
        <v-col cols="6" lg="6" md="6" class="d-flex py-0 justify-end justify-lg-end justify-md-end justify-sm-end">
          <div class="d-flex ">
            <nuxt-link to="/keranjang" class="text-decoration-none  ">
              <v-btn elevation="2" fab color="#ffffff" :small="$vuetify.breakpoint.smAndDown?true:false"
              ><v-icon   :small="$vuetify.breakpoint.smAndDown?true:false" color="#d9d9d9">mdi-cart</v-icon></v-btn
          >
        </nuxt-link>
        <nuxt-link to="/user-view" class="text-decoration-none ml-2" >
          <v-btn elevation="2" fab  color="#ffffff"   :small="$vuetify.breakpoint.smAndDown?true:false" >
            <v-avatar class="foto-profilan bg-greyku"  :size="$vuetify.breakpoint.smAndDown ? '35' : '50'" >
              <v-img
                :src="
                  'http://127.0.0.1:8000/storage/' +
                  $cookies.get(`cookieku`).data.foto_profil
                "
              />
            </v-avatar>
          </v-btn>
        </nuxt-link>
        <!-- <div class="display-5 my-auto ml-2 font-weight-bold text-truncate">{{ $cookies.get("cookieku").data.nama }}</div> -->
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
        foto_profil: null,
      },
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
/*
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
} */
/* .profile_icon_keranjang {
  display: flex;
  gap: 11px;
  margin-left: 32px;
}
.keranjang {
  margin-left: 5px;
} */
</style>
