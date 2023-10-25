<template>
  <div>
    <v-app>
      <Navbar />

      <div class="container">
        <v-row>
          <v-col
            cols="12 "
            lg="3"
            md="3"
            sm="12"
            xs="12"
            order="2"
            class="kiri py-0 justify-space-between order-lg-1 order-md-1 order-sm-2 order-xs-2"
          >
            <v-card v-if="!$vuetify.breakpoint.smAndDown" class="sidebar-profil pa-5 pt-8 rounded-lg" style="height:100%;">
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
                  :class="['font-weight-medium d-flex align-items my-4 justify-start py-6 text-capitalize', 'sidebtn-'+i, isaktif(rute.rt)?'border-left':'']"
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
          </v-col>
          <v-col
            cols="12"
            lg="9"
            md="9"
            sm="12"
            xs="12"
            order="1"
            class="d-flex my-0  py-0 order-lg-2 order-md-2 order-sm-1 order-xs-1 d-flex "
          >
            <div style="width: 100%;">
              <nuxt />
            </div>
          </v-col>
        </v-row>
      </div>
      <Footer />
    </v-app>
  </div>
</template>

  <script>
import axios from "axios";

export default {
  middleware: "middlewareku",
  data() {
    return {
      drawer:null,
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
    this.cekuserrole = usid.role;
    this.getuser();
    this.route();
  },
  mounted() {
    this.getuser();
  },
};
</script>

<style>
</style>

