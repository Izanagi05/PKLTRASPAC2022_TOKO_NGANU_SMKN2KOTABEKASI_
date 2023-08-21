<template>
  <div>
    <Navbar />
    <v-row>
      <v-col sm="3">
        <div class="sub-title" style="margin-left: 27px, margin-right=36px">
          Profil Pengguna
        </div>
        <div class="menu mt-2">
          <NuxtLink
            v-for="(menu, i) in menus"
            :key="i"
            :to="menu.link"
            class="my-4 black--text text-decoration-none"
          >
            <v-icon large>{{ menu.icon }}</v-icon> {{ menu.title }}
          </NuxtLink>

          <NuxtLink
            v-if="cekuserrole === 'Admin'"
            to="/halaman-admin"
            class="my-4 black--text text-decoration-none"
          >
            <v-icon large>mdi-database</v-icon> Admin
          </NuxtLink>

          <div v-else></div>
        </div>
        <div class="logout" style="margin-left: 27px">
          <v-btn text @click="logout()" class="mdi-35px"
            ><v-icon>mdi-logout</v-icon>Logout</v-btn
          >
        </div>
      </v-col>
      <!-- <v-col sm="9">
        <ProfileUser v-if="$route.path === 'profile-user'" />
        <TokoUser v-else-if="$route.path === 'toko-user'" />
      </v-col> -->
    </v-row>
  </div>
</template>

<script>
import axios from "axios";

// import ProfileUser from "~/pages/profile-user";
// import TokoUser from "~/pages/toko-user";

export default {
  // components: {
  //   ProfileUser,
  //   TokoUser,
  // },
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
      menus: [
        {
          title: "User Profile",
          link: "/user-view/profile-user",
          icon: "mdi-account",
        },
        { title: "Toko", link: "/user-view/toko-user", icon: "mdi-storefront" },
        {
          title: "Tambah Toko",
          link: "/user-view/tambah-toko",
          icon: "mdi-store-plus",
        },
        {
          title: "Tambah Barang",
          link: "/user-view/crud",
          icon: "mdi-package-variant-closed-plus",
        },
      ],
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
