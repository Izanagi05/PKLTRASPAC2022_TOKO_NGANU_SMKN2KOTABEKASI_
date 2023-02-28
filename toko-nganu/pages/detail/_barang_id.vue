<template>
  <div>
    <Navbar />
    <div class="navigasi ml-6">
      <nuxt-link to="/" class="text-decoration-none black--text">Home</nuxt-link
      ><span class="mdi mdi-chevron-right">Detail Barang</span>
    </div>
    <div class="content" v-for="(dtlbrg, index) in detailbarang" :key="index">
      <v-row>
        <v-col>
          <div class="foto-produk pt-4 pb-4" style="margin-left: 35px">
            <v-img :src="require('~/assets/barang.png')" width="479px"></v-img>
          </div>
        </v-col>
        <v-col>
          <div class="detail pt-4">
            <div class="nama-barang font-weight-bold" style="font-size: 30px">
              {{ dtlbrg.nama }}
            </div>
            <div class="harga font-weight-bold pt-3" style="font-size: 40px">
              Rp. 1.999.999
            </div>
            <div
              class="deskripsi font-weight-regular pt-3"
              style="font-size: 20px"
            >
              Bingung Masbro
            </div>
            <div>nama toko: {{ dtlbrg.toko.nama }}</div>
          </div>
          <div class="button pb-4" style="padding-top: 200px">
            <v-row>
              <v-col cols="4">
                <div class="tambah-troli pl-6">
                  <v-btn
                    class="rounded-pill"
                    x-large
                    outlined
                    @click="tambahkeranjang(dtlbrg)"
                    >Tambah <span class="mdi mdi-cart-outline"></span
                  ></v-btn>
                </div>
              </v-col>
              <v-col cols="6">
                <div class="beli-sekarang">
                  <v-btn
                    class="rounded-pill"
                    width="287px"
                    x-large
                    outlined
                    @click="nomer()"
                    style="background: #2f432d; color: white; size: 105px"
                    >Beli Sekarang</v-btn
                  >
                </div>
              </v-col>
            </v-row>
          </div>
        </v-col>
      </v-row>
      <div class="rekomendasi pb-6 item-center" style="margin-left: 35px">
        <v-row>
          <div class="recomend f24sb pt-5">Barang yang mungkin kamu suka</div>
          <div>
            <div class="product-card pt-4">
              <!-- <v-row class="p-0" v-bind="getbarang(dtlbrg)">
              <div v-for="(tk, index) in Toko" :key="index">
                <v-col class="card-col p-0">
                  <v-card width="204px">
                    <v-img
                      :src="require('~/assets/barang.png')"
                      width="204px"
                    ></v-img>
                    <v-row>
                      <v-col cols="5" class="">
                        <div class="title-product f14sb pl-1">{{ tk }}</div>
                      </v-col>
                      <v-col>
                        <div class="price-product f14sb pr-1">Rp. 1.999.999</div>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col>
                        <div class="desc-product font-weight-regular pl-1">
                          Bingung masbro
                        </div>
                      </v-col>
                    </v-row>
                    <div class="btn-card pl-1 pb-1">
                      <button
                        class="rounded-xl view-more-btn font-weight-regular"
                        style="font-size: 12px"
                      >
                        Lebih lengkap
                      </button>
                    </div>
                  </v-card>
                </v-col>
              </div>

            </v-row> -->
            </div>
            <!-- Lebih lengkap <v-btn @click="getbarang"></v-btn> -->
          </div>
        </v-row>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      prm: this.$route.params,
      detailbarang: null,
      userid: null,
      price: 1999999,
      dtlbrg: {
        barang_id: "",
        kauntitas: 1,
      },
      prm: this.$route.params,
      detailbarang: [],
      userid: null,
      // dtlbrg:{
      //   toko_id:'',
      //   barang_id:'',
      //   kuantitas:1,
      //   varian_id:1
      // },
      detbarker: {
        user_id: "",
        barang_id: 1,
        kuantitas: 1,
        varian_id: 1,
      },
      no_admin: "+62-815-6315-1038",
    };
  },
  methods: {
    getbarangtokobyid() {
      axios
        .get(
          "http://127.0.0.1:8000/api/getbarangtokobyid/" + this.prm.barang_id
        )
        .then((respon) => {
          this.detailbarang = respon.data;
        });
    },
    tambahkeranjang(dtlbrg) {
      axios
        .post(
          "http://127.0.0.1:8000/api/addkeranjangbyuser/" + this.userid,
          dtlbrg
        )
        .then((respon) => {
          console.log(respon);
        });
    },
    nomer() {
      let no = this.no_admin;
      let pesan =
        "Hi!%20Saya%20ingin%20memesan%20" +
        this.detailbarang +
        "%20sebanyak%20" +
        this.dtlbrg.kauntitas +
        "%20dengan%20harga%20Rp." +
        this.price;
      window.open(
        "https://api.whatsapp.com/send?phone=" + no + "&text=" + pesan
      );
    },
    pilihanvarian(varian) {
      this.pilihan = varian.varian_id;
      let namasetvar = varian.nama;
      // this.$toast.success("berhasil pilih varian "+ namasetvar);
      alert("varian pilihan :" + namasetvar);
      // if(this.setpil===0){
      //   this.$cookies.set('cookiekeranjang', {dataa: this.pilihan})
      //   this.setpil=1
      // }else if(this.setpil===1){
      //   this.setpil=0
      //   this.$cookies.remove('cookiekeranjang',  {dataa: this.pilihan})
      //   this.$cookies.set('cookiekeranjang', this.pilihan)
      // }
      // console.log(varian.varian_id)
    },
    tambahkeranjang() {
      // console.log(dtlbrg)
      (this.detbarker.user_id = this.userid),
        (this.detbarker.barang_id = this.prm.barang_id),
        (this.detbarker.kuantitas = 1),
        (this.detbarker.varian_id = this.pilihan);
      axios
        .post(
          "http://127.0.0.1:8000/api/addkeranjangbyuser/" + this.userid,
          this.detbarker
        )
        .then((respon) => {
          console.log(respon);
        });
      console.log(this.pilihan);
    },
  },

  created() {
    const usid = this.$cookies.get("cookieku");
    this.userid = usid.data.id;
    this.getbarangtokobyid();
  },
};
</script>
