<template>
  <div>
    <v-dialog v-model="dialogsearch" max-width="600px">
      <v-card class="pa-6 rounded-lg">
        <v-text-field
                class="nyari rounded-lg"
                v-model="cari"
                label="Cari Nganu"
                single-line
                hide-details
                outlined
                @keyup.enter="cari===''||cari===null?getkategori(-1):getkategori(-2)"
                append-icon="mdi-magnify"
                placehoder="cari"
              ></v-text-field>
            </v-card>
          </v-dialog>
    <div class="mb-10">
      <div class="container pb-4">
        <v-row>
          <v-col cols="8" lg="8" md="8" class="d-flex d-flex align-center">
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
          <v-col cols="4" lg="4" md="4" class="d-flex justify-end">
            <div flat class="rounded-pill" color="#d9d9d9">

              <v-btn
                elevation="2"
                fab
                color="#ffffff"
                @click="dialogsearch=true"
                :small="$vuetify.breakpoint.smAndDown ? true : false"
                ><v-icon
                  :small="$vuetify.breakpoint.smAndDown ? true : false"
                  color="#d9d9d9"
                  >mdi-magnify</v-icon
                ></v-btn
              >
            </div>
            <nuxt-link to="/keranjang" class="text-decoration-none ml-2">
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
                      UserLogin?.foto_profil
                    "
                  />
                </v-avatar>
              </v-btn>
            </nuxt-link>
            <!-- <div class="display-5 my-auto ml-2 font-weight-bold text-truncate">
              {{ $cookies.get("cookieku").data.nama }}
            </div> -->
          </v-col>
        </v-row>
      </div>
    </div>
    <div class="all-home">
      <div class="container">
        <div class="home-image">
          <v-carousel
            cycle
            height="auto"
            hide-delimiter-background
            show-arrows-on-hover
            class="object-fit-cover"
          >
            <v-carousel-item
              v-for="(item, i) in items"
              :key="i"
              :src="item.src"
            >
            </v-carousel-item>
          </v-carousel>
        </div>
        <div class="d-flex mt-8 overflow-x-auto">
          <v-btn
            outlined
            @click="getkategori(-1)"
            :class="[
              'ma-2  rounded-lg text-capitalize',
              fcek === true ? 'btn-warnaku white--text' : '',
            ]"
          >
            Semua Kategori
          </v-btn>
          <v-btn
            outlined
            v-for="(ktg, index) in allkategori"
            :class="[
              'ma-2  rounded-lg text-capitalize',
              ktg.kategori_id === fcek ? 'btn-warnaku white--text' : '',
            ]"
            :key="index"
            @click="getkategori(ktg.kategori_id)"
            class="ma-2 rounded-lg"
          >
            {{ ktg.nama }}
          </v-btn>
        </div>
        <div class="recomend font-weight-bold text-h6">
          Rekomendasi untuk anda
        </div>
        <div>
          <div class="product-card">
            <v-row class="p-0">
              <v-col
                cols="6"
                :class="[
                  '   mt-4   col-md-4  col-sm-6 col-xs-6 d-flex justify-center  ',
                  $vuetify.breakpoint.lgAndUp ? 'col-lg-5' : '',
                ]"
                v-for="(brg, index) in getdataall"
                :key="index"
              >
                <v-card
                  color="#ffffff"
                  class="rounded-lg"
                  elevation="1"
                  width="300"
                  @click="todetail(brg)"
                >
                  <div
                    v-for="(ft, i) in brg.barang_foto_first"
                    :key="i"
                    max-width="100"
                    class="image-container2 d-flex justify-center align-center"
                  >
                    <img
                      :src="'http://127.0.0.1:8000/storage/' + ft.file"
                      object-fit="cover"
                      width="100%"
                      height="100%"
                    />
                  </div>
                  <div class="pa-4">
                    <div class="font-weight-medium">
                      {{ brg.nama }}
                    </div>
                    <div
                      class="font-weight-medium d-flex"
                      v-for="(vrn, i) in brg.barang_varian_first"
                      :key="i"
                    >
                      <div v-if="brg" class="mr-1">Rp</div>

                      {{ vrn.harga }}

                    </div>
                    <v-row align="center">
                      <v-col cols="auto">
                        <div class="d-flex align-center">
                          <v-img
                            :src="
                              require('~/assets/pajamas_tanuki-verified.png')
                            "
                            max-width="16"
                          ></v-img>
                          <span class="ml-2">{{ brg.toko?.nama }}</span>
                        </div>
                      </v-col>
                    </v-row>
                    <div class="btn-card mt-2 pb-1 d-flex align-center">
                      <v-rating
                        v-model="brg.average_rating"
                        background-color="yellow"
                        color="yellow accent-4"
                        dense
                        half-increments
                        hover
                        size="18"
                      ></v-rating>
                      <p class="ma-0">{{ brg.average_rating }}</p>
                    </div>
                  </div>
                </v-card>
              </v-col>
            </v-row>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Footer from "~/components/Footer.vue";
export default {
  middleware: "middlewareku",
  data() {
    return {
      set: 0,
      cari: null,
      dialogsearch: false,
      fcek: null,
      rating: 1,
      currentRating: 0,

      hasilcari: [],
      no_admin: "6281563151038",
      nama: null,
      tokouser: null,
      Toko: null,
      barangparam: null,
      allbarang: {
        barang_id: "",
      },
      allkategori: {
        kategori_id: "",
      },
      getdataallcheck: -1,
      getdataall: [],
      items: [
        {
          src: "home-img.png",
        },
        {
          src: "home-img.png",
        },
        {
          src: "home-img.png",
        },
      ],
    };
  },
  computed: {
    UserLogin() {
      return this.$store.state.users.datauserlogin;
    },
  },
  methods: {
    setRating(rating) {
      this.currentRating = rating;
    },
    search() {
      console.log("ets" + this.searchteks);
    },
    kontak() {
      let nomer = this.no_admin;
      window.open("https://wa.me/" + nomer);
    },
    gettoko() {
      axios
        .get("http://127.0.0.1:8000/api/gettoko/" + this.tokouser)
        .then((respon) => {
          this.Toko = respon.data;
        });
    },
    getsearchbarang() {
      this.set = 2;
    },
    getallkategori() {
      axios.get("http://127.0.0.1:8000/api/getallkategori").then((respon) => {
        this.allkategori = respon.data?.data;
      });
    },
    getkategori(ktg) {
      this.getdataallcheck = ktg;
      if (this.getdataallcheck == -1) {
        axios
          .get("http://127.0.0.1:8000/api/getallbarangtoko")
          .then((respon) => {
            this.getdataall = respon.data?.data;
            console.log(this.getdataall);
          });
        this.fcek = true;
      } else if (this.getdataallcheck >= 0) {
        axios
          .get(`http://127.0.0.1:8000/api/getkategori/${ktg}`)
          .then((respon) => {
            this.getdataall = respon.data?.data[0]?.barang;
          });
        this.fcek = ktg;
      } else if (this.getdataallcheck == -2) {
        axios
          .get("http://127.0.0.1:8000/api/search/" + this.cari)
          .then((respon) => {
            this.getdataall = respon.data?.data;
            console.log(this.getdataall);
          });
          this.dialogsearch=false
      }
    },
    todetail(brg) {
      // console.log(brg.barang_id)
      this.$router.push(`/detail/${brg.barang_id}`);
    },
    todetail2(barang) {
      // console.log(brg.barang_id)
      this.$router.push(`/detail/${barang.barang_id}`);
    },
  },
  mounted() {},

  created() {
    const userid = this.$cookies.get("cookieku");
    this.nama = userid.data.nama;
    console.log(userid);
    this.tokouser = userid.data.id;
    this.gettoko();
    this.getallkategori();
    this.getkategori(-1);
    this.getsearchbarang();
    this.$store.dispatch("users/getuserlogin");
    // this.getallbarang();
  },
};
</script>
<style scoped>
.image-container2 {
  height: 200px;
  overflow: hidden;
}

.image-container2 img {
  object-fit: cover;
  object-position: center;
}
.col-lg-5 {
  flex: 0 0 20%;
  max-width: 20%;
}
</style>