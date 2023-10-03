<template>
  <div>

    <div class="pl-15 pb-5 font-weight-medium">Detail Varian</div>
    <DialogTambah
      :dialogtambah="dialogadd"
      item="Varian"
      :closetambah="closeadd"
      :detaildatadialog="detaildatadialog"
      :konfirmtambah="konfirmtambahvarian"
    />
    <DialogDelete
      :dialogDelete="dialogDelete"
      :confirmhapus="confirmhapusvarian"
      :closeDelete="closeDelete"
    />
    <DialogUpdate
      :dialogedit="dialogedit"
      item="Varian "
      :detaildatadialog="detaildatadialog"
      :closeedit="closeedit"
      :updateedit="updatevarian"
    />
    <div class=" pb-6 pl-4">
      <v-btn
        class="text-capitalize px-8 mb-6 text-body-1 font-weight-medium rounded-pill white--text"
        color="#4c60af"
        @click="tambahvarian()"
        >Tambah varian barang</v-btn
      >
    </div>
    <v-data-table data-app class="px-15" :headers="headers" :items="barang">
      <template v-slot:[`item.aksi`]="{ item }">
        <v-btn
          class="mx-2 white--text btn-crkuup"
          fab
          small
          @click="ubahvarian(item)"
        >
          <v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-btn
          class="mx-2 white--text btn-crkuhap"
          fab
          small
          @click="hapusvarian(item)"
        >
          <v-icon>mdi-delete</v-icon>
        </v-btn>
      </template>
      <template v-slot:[`item.nomor`]="{ index }">
        <div>
          {{ index + 1 }}
        </div>
      </template>
    </v-data-table>
  </div>
</template>
<script>
import axios from "axios";
export default {
  layout: 'UserView',
  middleware: "middlewareku",
  data() {
    return {
      prm: this.$route.params,
      dialogadd: false,
      dialogedit: false,
      dialogDelete: false,
      barang: [],
      varianbarang: null,
      headers: [
        { text: "Nama varian", value: "nama" },
        { text: "harga", value: "harga" },
        { text: "stok", value: "stok" },
        { text: "Aksi", value: "aksi" },
      ],
      varid: {
        varian_id: "",
      },
      detaildatadialog: {
        nama: "",
        harga: "",
        stok: "",
      },
      defaultItem: {
        nama: "",
        harga: "",
        stok: "",
      },
    };
  },
  methods: {
    getvarian() {
      axios
        .get("http://127.0.0.1:8000/api/getvarianbarang/" + this.prm.barang_id)
        .then((respon) => {
          this.barang = respon.data?.data;
        });
    },
    closeadd() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.dialogadd = false;
    },
    tambahvarian() {
      this.dialogadd = true;
    },
    konfirmtambahvarian() {
      axios
        .post(
          "http://127.0.0.1:8000/api/createvarianbarang/" + this.prm.barang_id,
          this.detaildatadialog
        )
        .then((respon) => {
          console.log(respon);
          // this.barang.push(this.detaildatadialog)
          this.getvarian();
        });
      this.$toast.success("Berhasil tambah");
      this.closeadd();
    },

    ubahvarian(item) {
      this.indexnya = this.barang.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.varid = Object.assign({}, item);
      this.dialogedit = true;
    },
    closeedit() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.dialogedit = false;
    },
    updatevarian() {
      axios
        .post(
          "http://127.0.0.1:8000/api/updatevarianbarang/" +
            this.varid.varian_id,
          this.detaildatadialog
        )
        .then((respon) => {
          console.log(respon.data);
          this.getvarian();
          // Object.assign(this.barang[this.indexnya], this.detaildatadialog)
          this.$toast.success("Berhasil update");
        });
      this.dialogedit = false;
    },

    hapusvarian(item) {
      this.editedIndex = this.barang.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.dialogDelete = true;
    },
    confirmhapusvarian() {
      axios
        .delete(
          "http://127.0.0.1:8000/api/deletevarianbarang/" +
            this.detaildatadialog.varian_id
        )
        .then((respon) => {
          console.log(respon);
          this.getvarian();
          this.$toast.success("Berhasil hapus");
        });
      this.barang.splice(this.editedIndex, 1);
      this.closeDelete();
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
  },

  created() {
    const barangid = this.$cookies.get("cookieku");
    this.varianbarang = barangid.data.id;
    this.getvarian();
  },
};
</script>
