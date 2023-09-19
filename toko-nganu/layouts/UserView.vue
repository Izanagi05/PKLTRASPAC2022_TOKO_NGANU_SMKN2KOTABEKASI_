<template>
  <div>
    <Navbar />
    <v-row>
      <v-col sm="3" class="mt-5">
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
      <v-col sm="9">
        <nuxt />
      </v-col>
    </v-row>
  </div>
</template>
  
  <script>
import axios from "axios";

export default {
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

  