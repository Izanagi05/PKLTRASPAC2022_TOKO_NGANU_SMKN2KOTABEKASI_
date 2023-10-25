<template>
  <div style="margin-bottom: 100px;">
  <div style="position: fixed; width: 100%;z-index: 200;">
    <v-card
      :class="['rounded-0 white pa-0', $vuetify.breakpoint.mdAndUp ? '' : '']"
      elevation="6"
    >
      <div class="container">
        <v-row class="my-0">
          <!-- <v-col cols="6" lg="6" md="6" class="d-flex py-0 d-flex align-center"> -->
            <!-- </v-col> -->
            <v-col cols="8" lg="8" md="8" class="d-flex py-0 d-flex align-center">

              <v-icon v-if="$vuetify.breakpoint.smAndDown" color="black" class="mr-2"  @click.stop="drawer = !drawer">mdi-menu</v-icon>
            <v-img
              :src="require('~/assets/logo_nganu.png')"
              :max-width="$vuetify.breakpoint.smAndDown ? '20' : '30'"
            ></v-img>
            <div
              :class="[
                'font-weight-bold',
                $vuetify.breakpoint.smAndDown ? 'ml-2' : 'ml-4 text-h6',
              ]"
            >
              Toko nganu
            </div>
          </v-col>
          <v-col
            cols="4"
            lg="4"
            md="4"
            class="d-flex py-0 justify-end justify-lg-end justify-md-end justify-sm-end"
          >
            <div class="d-flex">
              <nuxt-link to="/keranjang" class="text-decoration-none">
                <v-btn
                  elevation="2"
                  fab
                  color="#ffffff"
                  :small="$vuetify.breakpoint.smAndDown ? true : false"
                  ><v-icon
                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                    color="#d9d9d9"
                    >mdi-cart</v-icon
                  ></v-btn
                >
              </nuxt-link>
              <nuxt-link to="/user-view" class="text-decoration-none ml-2">
                <v-btn
                  elevation="2"
                  fab
                  color="#ffffff"
                  :small="$vuetify.breakpoint.smAndDown ? true : false"
                >
                  <v-avatar
                    class="foto-profilan bg-greyku"
                    :size="$vuetify.breakpoint.smAndDown ? '35' : '50'"
                  >
                    <v-img
                      :src="
                        'http://127.0.0.1:8000/storage/' +
                        datauserLoginKu?.foto_profil
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
    </v-card>
    <v-navigation-drawer v-if="$vuetify.breakpoint.smAndDown" class="rounded-xl"
      style="position: fixed"
      v-model="drawer"
      temporary
    >
    <v-card class="sidebar-profil container  rounded-e-lg" style="height:100%;">
      <v-icon v-if="$vuetify.breakpoint.smAndDown" color="black" class="mr-2 my-4"  @click.stop="drawer = !drawer">mdi-close</v-icon>
              <div
                :class="[
                  'font-weight-bold  mb-4',
                  $vuetify.breakpoint.smAndDown ? 'text-subtitle-6' : 'text-h5',
                ]"
              >
                Profil Pengguna
              </div>
              <div v-for="(rute, i) in routersdata" :key="i">
                <v-btn
                  text
                  depressed
                  @click="$router.push(rute.rt)"
                  width="100%"
                  :class="['font-weight-medium d-flex align-items my-4 justify-start py-6 text-capitalize', isaktif(rute.rt)?'border-left':'']"
                >
                  <v-icon large color="#616161" class="mr-2">{{
                    rute.icon
                  }}</v-icon>
                  <div :class="[isaktif(rute.rt)?'font-weight-medium black--text':'font-weight-regular grey--text text--lighten-1']">
                   {{ rute.nama }}
                  </div>
                </v-btn>
              </div>
              <div>
                <v-btn
                  text
                  depressed
                  @click="logout()"
                  width="100%"
                  class="font-weight-medium d-flex mt-15 align-items justify-start py-8 text-capitalize"
                  ><v-icon large color="#616161" class="mr-2">mdi-logout</v-icon
                  >Logout</v-btn
                >
              </div>
            </v-card>
    </v-navigation-drawer>
  </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      drawer: null,
      cekuserrole: null,
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
      datauserLoginKu:[]
    };
  },
  computed: {
    UserLogin() {
      return this.$store.state.users.datauserlogin;
    },
  },
  methods: {
     route() {
      var rutes = [
        {
          show: true,
          nama: "Info User",
          rt: "/user-view",
          icon: "mdi-account",
        },
        {
          show: this.cekuserrole === "Admin",
          nama: "Admin",
          rt: "/halaman-admin",
          icon: "mdi-account-tie",
        },
        {
          show: true,
          nama: "Toko",
          rt: "/user-view/toko-user",
          icon: "mdi-storefront",
        },
        {
          show: true,
          nama: "Buka Toko",
          rt: "/user-view/tambah-toko",
          icon: "mdi-store-plus",
        },
        {
          show: true,
          nama: "Tambah Barang",
          rt: "/user-view/tambah-barang",
          icon: "mdi-package-variant-closed-plus",
        },
        {
          show: true,
          nama: "Manajemen Toko",
          rt: "/user-view/manajemen-toko",
          icon: "mdi-store-check-outline",
        },
      ];
      this.routersdata = rutes.filter(function (link) {
        return link.show;
      });
    },
       isaktif (pathh) {
      return this.$route.path === pathh
    },
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
    logout() {
      this.$store.dispatch("users/logout");
    },
  },
  created() {
    this.datauserLoginKu=this.$cookies.get('cookieku')?.data
    this.$store.dispatch("toko/getdatatoko", this.tokouser);
    this.getuserlogin();
    this.route();
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
