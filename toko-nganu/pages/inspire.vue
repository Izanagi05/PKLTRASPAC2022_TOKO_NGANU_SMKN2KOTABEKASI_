<template>
  <div>
    <div class="mb-10 ">
      <div class="btn-warnaku white--text">
        <div class="py-2 font-weight-regular">
          <button class=" ml-4" type="submit" @click="kontak">
            <v-icon color="white">mdi-phone</v-icon>
            +62-815-6315-10389
          </button>
        </div>
      </div>
      <div class="container pb-4">
        <v-row>
          <v-col class="d-flex col-12 col-lg-6 col-md-4  col-sm-12 col-xs-12 d-flex align-center">
            <v-img :src="require('~/assets/logo_nganu.png')" max-width="40"></v-img>
            <div class="font-weight-bold text-h5 ml-4">Toko nganu</div>
          </v-col>
          <v-col class="d-flex col-12 col-lg-6 col-md-8 col-sm-12 col-xs-12 justify-end">
            <div flat class="rounded-pill  " color="#d9d9d9">
              <v-text-field class="nyari rounded-pill" v-model="cari" label="Cari Nganu" single-line hide-details outlined
                @keyup.enter="getkategori(-2)" append-icon="mdi-magnify" placehoder="cari"></v-text-field>
            </div>
            <nuxt-link to="/keranjang" class="text-decoration-none ml-2">
              <v-btn elevation="2" fab color="d9d9d9" icon><v-icon size="29px">mdi-cart</v-icon></v-btn>
            </nuxt-link>
            <nuxt-link to="/user-view" class="text-decoration-none ml-2">
              <v-btn elevation="2" fab icon color="d9d9d9">

                <v-avatar class="bg-greyku">
                  <img :src="'http://127.0.0.1:8000/storage/' +
                    $cookies.get(`cookieku`).data.foto_profil
                    " />
                </v-avatar>
              </v-btn>
            </nuxt-link>
            <div class="display-5 my-auto ml-2 font-weight-bold  text-truncate">{{ $cookies.get('cookieku').data.nama }}
            </div>
          </v-col>
        </v-row>
      </div>
    </div>
    <div class="all-home">
      <div class="container">
        <div class="home-image">
          <v-carousel cycle height="auto" hide-delimiter-background show-arrows-on-hover class="object-fit-cover ">
            <v-carousel-item v-for="(item, i) in items" :key="i" :src="item.src">
            </v-carousel-item>
          </v-carousel>
        </div>
        <div class="d-flex mt-8">
          <v-btn outlined @click="getkategori(-1)"
            :class="['ma-2  rounded-xl text-capitalize',fcek === true ? 'btn-warnaku white--text' : '']"> Semua Kategori </v-btn>
          <v-btn outlined v-for="(ktg, index) in allkategori"
            :class="['ma-2  rounded-xl text-capitalize',ktg.kategori_id === fcek ? 'btn-warnaku white--text' : '']" :key="index"
            @click="getkategori(ktg.kategori_id)" class="ma-2 rounded-xl"> {{
              ktg.nama }} </v-btn>
        </div>
        <div class="recomend font-weight-bold text-h6">Rekomendasi untuk anda</div>
        <div>
          <div class="product-card">
              <v-row class="p-0  ">
                <v-col cols="6" :class="[ '   mt-4   col-md-4  col-sm-6 col-xs-6 d-flex justify-center  ', $vuetify.breakpoint.lgAndUp?'col-lg-5':'']"
                  v-for="(brg, index) in getdataall" :key="index">
                  <v-card color="#ffffff" class="rounded-lg " width="300">
                    <div v-for="(ft, i) in  brg.barang_foto_first" :key="i" max-width="100"
                      class="image-container3 d-flex justify-center align-center">
                      <img :src="'http://127.0.0.1:8000/storage/' + ft.file" object-fit="cover" width="100%"
                        height="100%" />
                    </div>
                    <div class="pa-4">
                      <div class=" font-weight-medium ">
                        {{ brg.nama }}
                      </div>
                      <div class=" font-weight-medium d-flex " v-for="(vrn, i) in  brg.barang_varian_first" :key="i">
                        <div v-if="brg">
                          Rp.
                        </div>
                        {{ vrn.harga }}
                      </div>
                      <div class=" font-weight-regular ">
                        {{ brg.deskripsi }}
                      </div>
                      <div class="btn-card mt-2   pb-1">
                        <v-btn class="rounded-xl text-capitalize   font-weight-regular" outlined color="#000" small
                          @click="todetail(brg)">
                          Lebih lengkap
                        </v-btn>
                      </div>
                      <v-rating  color="yellow-darken-3" v-model="rating" length="5"></v-rating>
                    </div>
                  </v-card>
                </v-col>
              </v-row>
            </div>
          <div>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import axios from "axios";
import Footer from '~/components/Footer.vue'
export default {
  middleware: "middlewareku",
  data() {
    return {
      set: 0,
      cari: null,
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
      getdataallcheck:-1,
      getdataall:[],
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
  methods: {
    setRating(rating) {
      this.currentRating = rating;
    },
    search() {
      console.log("ets" + this.searchteks)
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
      this.getdataallcheck=ktg
      if(this.getdataallcheck==-1){
        axios.get("http://127.0.0.1:8000/api/getallbarangtoko").then((respon) => {
        this.getdataall = respon.data?.data;
        console.log(this.getdataall)
      });
        this.fcek = true
      }else if(this.getdataallcheck>=0){
        axios
        .get(`http://127.0.0.1:8000/api/getkategori/${ktg}`)
        .then((respon) => {
          this.getdataall = respon.data?.data[0]?.barang;
        });
        this.fcek = ktg
      }else if(this.getdataallcheck==-2){
        axios.get("http://127.0.0.1:8000/api/search/" + this.cari).then((respon) => {
          this.getdataall = respon.data?.data;
          console.log(this.getdataall)
      });
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
  mounted () {

    },


  created() {
    const userid = this.$cookies.get("cookieku");
    this.nama = userid.data.nama;
    console.log(userid);
    this.tokouser = userid.data.id;
    this.gettoko();
    this.getallkategori();
    this.getkategori(-1);
    this.getsearchbarang();
    // this.getallbarang();
  },
};
</script>
<style scoped>


.image-container3 {
  height: 200px;
  overflow: hidden;
}

.image-container3 img {
  object-fit: cover;
  object-position: center;
}
.col-lg-5 {
  flex: 0 0 20%;
  max-width: 20%;
}
</style>
