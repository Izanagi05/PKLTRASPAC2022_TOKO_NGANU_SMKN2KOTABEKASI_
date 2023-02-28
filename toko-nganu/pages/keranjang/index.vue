<template>
  <div>
    <Navbar />
    <div>
      <v-dialog v-model="dialogDelete" max-width="500px">
        <v-card>
          <v-card-title class="text-h5">Yakin ingin menghapus?</v-card-title>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue-darken-1" variant="text" @click="closeDelete"
              >Cancel</v-btn
            >
            <v-btn
              color="blue-darken-1"
              variant="text"
              @click="confirmhapuskeranjang"
              >OK</v-btn
            >
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <div class="cart">
        <v-row>
          <v-col class="">
            <v-row>
              <v-col>
                <div class="f14sb head-title">Produk</div>
              </v-col>
              <v-col>
                <div class="f14sb head-title">Harga</div>
              </v-col>
              <v-col>
                <div class="f14sb head-title">Jumlah</div>
              </v-col>
              <v-col>
                <div class="f14sb head-title">Total</div>
              </v-col>
            </v-row>
            <v-row>
              <div
                class="cart-content"

              >
              <!-- <div v-for="gthrg in varharga" :key="gthrg">

                <div v-on="ambilharga(gthrg)">

                </div>
              </div> -->
              <!-- <div v-on="getharga()">l</div> -->
              <!-- <div v-on="getharga()"></div> -->
                <div v-for="(dataa, index) in datakeranjang.user_keranjang" :key="index">
          </v-col>
        </v-row>
        <v-row>
          <div
            class="cart-content"
            v-for="(user, index) in datakeranjang"
            :key="index"
          >
            <div v-for="(dataa, index) in user.user_keranjang" :key="index">
              <!-- {{ datakeranjang.user_keranjang.varian_id }} -->
              <div class="cart-content">
                <div
                  v-for="(dataa, index) in datakeranjang.user_keranjang"
                  :key="index"
                >
                  <v-row>
                    <!-- {{ dataa.varian_id }} -->

                    <div class="cart-card d-flex" >
                      <v-col>
                        <v-img
                          :src="require('~/assets/barang.png')"
                          width="143px"
                        ></v-img>
                      </v-col>
                      <v-col>
                        <div class="font-weight-medium">
                          barang:{{ namabarangker }}
                        </div>
                      </v-col>
                      <v-col>
                        <div class="font-weight-medium">
                          varian:{{dataa.varian_id}}
>>>>>>> b3eefa9183259060c1daffe4bd1da136439569d3
                        </div>
                      </v-col>
                      <v-col>
                        <div class="font-weight-medium">Rp. {{ price }}</div>
                      </v-col>
                      <v-col>
                        <div class="d-flex kuantitas">
                          <div>
                            <div v-if="dataa.kuantitas == 1">
                              <button @click="countmin(dataa)" disabled type="submit">
                                <v-icon color="AAAAAA">mdi-minus</v-icon>
                              </button>
                            </div>
                            <div v-else>
                              <button @click="countmin(dataa)" type="submit">
                                <v-icon color="black">mdi-minus</v-icon>
                              </button>
                            </div>
                          </div>

                          <div class="font-weight-medium">
                            {{ dataa.kuantitas }}
                          </div>
                          <button
                            class="pluskuantitas"
                            @click="countplus(dataa)"
                            type="submit"
                          >
                            <v-icon color="black">mdi-plus</v-icon>
                          </button>
                        </div>
                      </v-col>
                      <v-col>
                        <div class="font-weight-medium">Rp. {{totalprice}}</div>
                      </v-col>
                    </div>
<<<<<<<<< Temporary merge branch 1
                    <div><v-btn @click="hapuskeranjang(dataa)"><v-icon>mdi-delete</v-icon></v-btn></div>
=========
                    <div>
                      <v-btn @click="hapuskeranjang(dataa)"
                        ><v-icon>mdi-trash</v-icon></v-btn
                      >
                    </div>
>>>>>>>>> Temporary merge branch 2
                  </v-row>
                </div>
                <div>
                  <v-btn @click="hapuskeranjang(dataa)"
                    ><v-icon>mdi-delete</v-icon></v-btn
                  >
                </div>
              </div>
            </div>
          </div>
        </v-row>
      </div>
    </div>

          <v-col class="">
            <div class="total-detail">
              <div class="rincian-title">Rincian Order</div>
              <v-row>
                <v-col>
                  <div>
                    <div class="line"></div>
                    Jumlah
                  </div>
                </v-col>
                <v-col class="f14sb"> x40 </v-col>
              </v-row>
              <v-row>
                <v-col> Harga </v-col>
                <v-col class="f14sb"> Rp. {{ price }} </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <div class="line"></div>
                  Total Harga
                </v-col>
                <v-col class="f14sb"> Rp. {{ pricetotal }} </v-col>
              </v-row>
              <div class="f24sb">
                <button
                  class="checkout-btn text-decoration-none white--text"
                  @click="nomer()"
                  type="submit"
                >
                  Checkout
                </button>
              </div>
            </div>
          </v-col>
        </v-row>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  middleware: "middlewareku",
  data() {
    return {
      dialogDelete: false,
      price: 100000,
      varharga:[],
      pricetotal: 0,
      getidker:null,
      kuan:1,
      totalprice:0,
      namabarangker:null,
      datakeranjang: {
        barang_id: "",
        kuantitas: "",
      },
      // editedIndex:0,
      detaildatadialog: {
        keranjang_user_id: "",
        barang_id: "",
        varian_id: "",
        kuantitas: "",
      },
      userid: null,
      no_admin: "+62-815-6315-1038",
      tesbarang: "barang ini",
      tes: [
        { title: "tes tes tes1", kuantitas: 1 },
        { title: "tes tes tes2", kuantitas: 0 },
        { title: "tes tes tes3", kuantitas: 0 },
        { title: "tes tes tes4", kuantitas: 0 },
        { title: "tes tes tes5", kuantitas: 0 },
        { title: "tes tes tes6", kuantitas: 0 },
        { title: "tes tes tes7", kuantitas: 0 },
        { title: "tes tes tes7", kuantitas: 0 },
      ],
    };
  },
  methods: {
    gethargavarian() {
      // console.log(this.datakeranjang);
      // axios.get('http://127.0.0.1:8000/api/barangvarianharga/'+this.datakeranjang.barang_id+ this.datakeranjang.varian_id).then(respon=>{
      //   console.log(respon.data)
      // })
    },
    getkeranjang() {
      axios
        .get("http://127.0.0.1:8000/api/keranjangbyuser/" + this.userid)
        .then((respon) => {
          this.datakeranjang = respon.data;
        });
    },
    getharga(){
      axios.get('http://127.0.0.1:8000/api/getvarian/'+this.getidker.varian_id).then(respon=>{
        // if(){

          this.varharga = respon.data[0]
        // }
        this.totalprice=this.varharga.harga
      })
    },
    getbarangnama(){
      axios.get('http://127.0.0.1:8000/api/getbarangtokobyid/'+this.getidker.barang_id).then(respon=>{
     this.namabarangker= respon.data[0].nama
      })
    },
    getidkeranjang() {
      axios
        .get("http://127.0.0.1:8000/api/keranjanguser/" + this.userid)
        .then((respon) => {
          this.getidker = respon.data;
          this.getharga()
          this.getbarangnama()

        });
    },

    countplus(dataa) {
      if(dataa.kuantitas <= this.varharga.stok){
        dataa.kuantitas++;
      }else{

      }
      this.totalprice= parseInt(dataa.kuantitas) * parseInt(this.varharga.harga)
      this.kuan = dataa.kuantitas
    },
    countmin(dataa) {
        dataa.kuantitas -=1;
        this.kuan = dataa.kuantitas
        this.totalprice= parseInt(this.totalprice) - parseInt(this.varharga.harga)
    },
    hapuskeranjang(item) {
      this.detaildatadialog = Object.assign({}, item);
      this.dialogDelete = true;
      console.log(this.editedIndex);
=======
    hapuskeranjang (item) {
      this.editedIndex = this.datakeranjang.indexOf(item)
        this.detaildatadialog = Object.assign({}, item)
        this.dialogDelete = true
        console.log(this.editedIndex)
      },
    confirmhapuskeranjang(){
      axios.delete('http://127.0.0.1:8000/api/deletekeranjang/'+ this.detaildatadialog.keranjang_user_id).then(respon =>{
       console.log(respon)
       location.reload()
        alert('berhasil hapus')
        })
        this.closeDelete()

  },
  closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedIndex = -1
        })
      },
>>>>>>> b3eefa9183259060c1daffe4bd1da136439569d3
    },
    confirmhapuskeranjang() {
      axios
        .delete(
          "http://127.0.0.1:8000/api/deletekeranjang/" +
            this.detaildatadialog.keranjang_user_id
        )
        .then((respon) => {
          console.log(respon);
          location.reload();
          alert("berhasil hapus");
        });
      this.closeDelete();
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedIndex = -1;
      });
    },

    nomer() {

      let no = this.no_admin;
      let pesan =
        "Hi!%20Saya%20ingin%20memesan%20" +
        this.namabarangker + " dengan%20varian%20" +this.varharga.nama+
        "%20seharga%20Rp." +
        this.totalprice
      window.open(
        "https://api.whatsapp.com/send?phone=" + no + "&text=" + pesan
      );
    },
  },
  created() {
    const usid = this.$cookies.get("cookieku");
    this.userid = usid.data.id;
    this.gethargavarian();
    this.getkeranjang();
    this.getidkeranjang();
  },
};
</script>
<style>
.f24sb {
  font-weight: 600;
  font-size: 24px;
  line-height: 36px;
}
.f20sb {
  font-weight: 600;
  font-size: 20px;
  line-height: 36px;
}
.f16sb {
  font-weight: 600;
  font-size: 16px;
  line-height: 24px;
}
.f14sb {
  font-weight: 600;
  font-size: 14px;
  line-height: 21px;
}
.f16m {
  font-weight: 500;
  font-size: 16px;
  line-height: 24px;
}
.f16r {
  font-weight: 400;
  font-size: 16px;
  line-height: 24px;
}
.f10r {
  font-weight: 400;
  font-size: 10px;
  line-height: 15px;
}

.line {
  width: 287px;
  height: 1px;
  background: black;
}
.cart {
  padding-left: 123px;
  padding-bottom: 35px;
}
.cart-content {
  padding-right: 52px;
  height: 764px;
}
.head-title {
  color: #7a7a7a;
}
.kuantitas {
  background: #d9d9d9;
  border-radius: 15px;
}

.total-detail {
  background: #d9d9d9;
  padding: 18px 40px 20px 40px;
  border-radius: 50px;
  width: 367px;
}
.rincian-title {
  font-weight: 600;
  font-size: 20px;
  line-height: 30px;
}
.checkout-btn {
  padding: 6px 83px;
  background: #2f432d;
  color: white;
  border-radius: 50px;
}
</style>
