<template>
  <div>
    <div class=" ">
      <div class="mb-4">
        <NuxtLink to="/" class="my-2 text-decoration-none black--text">
          Home </NuxtLink
        ><span class="mdi mdi-chevron-right"><b>Profil Pengguna</b></span>
      </div>
      <div
        :class="[
          'font-weight-bold  mb-2',
          $vuetify.breakpoint.smAndDown ? 'text-subtitle-1' : 'text-h6',
        ]"
      >
        Profil Pengguna
      </div>
      <div>
        <div class="d-flex mt-4">
          <v-avatar class="foto-profilan" :size="$vuetify.breakpoint.smAndDown?'100':'200'">
            <v-img
              v-if="dataprofil.foto_profil"
              class="img-fluid"
              :src="'http://127.0.0.1:8000/storage/' + dataprofil.foto_profil"
            />
          </v-avatar>

          <div class="d-flex ml-8 align-center">
            <div class="">
              <div class="text-lg-h4 text-md-h4 text-sm-h6 text-h6 font-weight-medium">
                {{ dataprofil.nama }}
              </div>
              <div :class="['grey--text ',$vuetify.breakpoint.smAndDown?'text-body-1':'text-body-1']">
                {{ dataprofil.email }}
              </div>
              <v-btn  v-if="$vuetify.breakpoint.smAndDown"
              class="text-capitalize font-weight-medium text-body-1 mx-auto mt-2" width="80%"
              outlined
              small
              rounded-lg
              @click="pushprofil"
            >
              Edit Profil
            </v-btn>
            </div>
          </div>
        </div>
          <div class="d-flex justify-end">

        </div>
        <v-row class=" mt-4">
          <v-col cols="12" class="">
            <div  :class="[
          'font-weight-bold  mb-2',
          $vuetify.breakpoint.smAndDown ? 'text-subtitle-1' : 'text-h6',
        ]">Info pengguna</div>
          </v-col>
          <v-col cols="12" lg="12" md="12">
            <v-row>
              <v-col cols="12" lg="6" class="pb-0">
                <div :class="['grey--text text-body-1 mb-4',$vuetify.breakpoint.smAndDown?'d-block mb-4 ':'d-flex']">
                  <p class="ma-0 mr-2">
                    Nama:
                  </p>
                  <p class="ma-0  black--text">
                    {{ dataprofil.nama }}
                  </p>
                </div>
                <div :class="['grey--text text-body-1 mb-4',$vuetify.breakpoint.smAndDown?'d-block mb-4':'d-flex']">
                  <p class="ma-0 mr-2">
                    Email:
                  </p>
                  <p class="ma-0  black--text">
                    {{ dataprofil.email }}
                  </p>
                </div>

              </v-col>
              <v-col cols="12" lg="6" class="pt-0">
                <div :class="['grey--text text-body-1 mb-4',$vuetify.breakpoint.smAndDown?'d-block mb-4':'d-flex']">
                  <p class="ma-0 mr-2">
                    Telepon:
                  </p>
                  <p class="ma-0  black--text">
                    {{ dataprofil.no_telepon }}
                  </p>
                </div>


              </v-col>
            </v-row>
          </v-col>
          <v-col cols="12" v-if="$vuetify.breakpoint.mdAndUp" class="mt-4 d-flex justify-center">
            <v-btn
              class="font-weight-medium px-15"
              outlined

              rounded-lg
              @click="pushprofil"
            >
              Edit Profil
            </v-btn>
          </v-col>
        </v-row>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

// import ProfileUser from "~/pages/profile-user";
// import TokoUser from "~/pages/toko-user";

export default {
  layout: "UserView",
  // components: {
  //   ProfileUser,
  //   TokoUser,
  // },
  middleware: "middlewareku",
  data() {
    return {
      routersdata: [],
      avatarResp: 250,
      dataprofil: {
        nama: null,
        no_telepon: null,
        email: null,
      },
      cekuserrole: null,
      userid: null,
      menus: [
        {
          class: "userprofile",
          title: "User Profile",
          link: "/user-view/profile-user",
          icon: "mdi-account",
        },
        {
          class: "toko",
          title: "Toko",
          link: "/user-view/toko-user",
          icon: "mdi-storefront",
        },
        {
          class: "tambahtoko",
          title: "Tambah Toko",
          link: "/user-view/tambah-toko",
          icon: "mdi-store-plus",
        },
        {
          class: "tambahbarang",
          title: "Tambah Barang",
          link: "/user-view/crud",
          icon: "mdi-package-variant-closed-plus",
        },
      ],
    };
  },

  methods: {
    responsAv() {
      if (this.$vuetify.breakpoint.mdAndUp) {
        this.avatarResp = 250;
      } else if (this.$vuetify.breakpoint.smAndUp) {
        this.avatarResp = 10;
      }
    },
    rutess() {
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
      ];
      this.routersdata = rutes.filter(function (link) {
        return link.show;
      });
    },
    getuser() {
      axios
        .get("http://127.0.0.1:8000/api/getuserlogin/" + this.userid)
        .then((respon) => {
          this.dataprofil = respon.data?.data;
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
    this.responsAv();
    const usid = this.$cookies.get("cookieku");
    this.userid = usid.data.id;
    this.cekuserrole = usid.role;
    this.rutess();
    this.getuser();
  },
  mounted() {
    this.getuser();
  },
};
</script>
<style scoped>
.pembatas {
  border-left: 8px solid #d9d9d9;
  border-radius: 20px;
  height: 450px;
  margin-right: 10px;
}
</style>
