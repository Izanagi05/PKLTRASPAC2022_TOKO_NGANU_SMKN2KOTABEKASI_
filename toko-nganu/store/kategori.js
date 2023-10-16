import axios from 'axios'
export const state = () => ({
  alldatakategori: [],
  // editedIndex: -1
  response:null

})

export const mutations= {
  GET_DATA(state, parsdata){
    state.alldatakategori=parsdata
    // console.log(parsdata)
  },
  CREATE_DATA(state, adddata){
    state.alldatakategori.push(adddata)
    // console.log(parsdata)
  },
  UPDATE_DATA(state, updtdata){
    const index = state.alldatakategori.findIndex(item => item.kategori_id === parseInt(updtdata.kategori_id));
    // const index = state.alldatakategori.findIndex(item => item.kategori_id === updtdata.kategori_id);
    if (index !== -1) {
    // console.log(parsdata)
    const datasementara= state.alldatakategori

    datasementara[index]= updtdata
    state.alldatakategori=[...datasementara]
  }
  console.log(updtdata.kategori_id);
  },
  DELETE_DATA(state, id){

    const index = state.alldatakategori.findIndex(item => item.kategori_id === id);

    if (index !== -1) {
      // Hapus item dari array
      state.alldatakategori.splice(index, 1);
    }

  }

}
export const getters = {
  getdata: (state)=> state.alldatakategori,
  getresp: (state)=> state.response

}

export const actions ={
  async getdatakategori({commit}, paramId){
    axios.get("http://127.0.0.1:8000/api/getallkategori").then((respon) => {
      commit('GET_DATA', respon.data?.data)
      // this.barang = respon.data?.data;
    });
  },
  async tambahdata({commit}, newData){
    const formData = new FormData();
    formData.append("nama", newData.nama);
    formData.append("harga", newData.harga);
    formData.append("stok", newData.stok);
    formData.append(
      "foto_barang_kategori",
      newData.foto_barang_kategori
    );
    axios
      .post(
        "http://127.0.0.1:8000/api/createkategoribarang/" + newData.idbrg,
        formData,
        {
          "content-type": "multipart/form-data",
        }
      )
      .then((respon) => {
        commit('CREATE_DATA', respon.data?.data)
        console.log(respon);
        // this.$store.dispatch('getdatakategori', newData.idbrg);
        // this.barang.push(this.detaildatadialog)
        // this.getkategori();
      });
  },
  async ubahdata({commit}, updatedata){
    const formData = new FormData();
    formData.append("nama", updatedata.nama);
    formData.append("harga", updatedata.harga);
    formData.append("stok", updatedata.stok);
    if (updatedata.fotosementara) {
      formData.append("foto_barang_kategori", updatedata.fotosementara);
    } else {
      formData.append(
        "foto_barang_kategori",
        updatedata.foto_barang_kategori
      );
    }
    axios
      .post(
        "http://127.0.0.1:8000/api/updatekategoribarang/" +
          updatedata.kategori_id,
        formData,
        {
          "content-type": "multipart/form-data",
        }
      )
      .then((respon) => {
        commit('UPDATE_DATA', respon.data?.data)

        // this.getkategori();
        this.$toast.success("Berhasil update");
      });
  },
  async hapusdata({commit}, iddata){
    axios
    .delete(
      "http://127.0.0.1:8000/api/deletekategoribarang/" +
      iddata
      )
      .then((respon) => {
      commit('DELETE_DATA', iddata)
      console.log(respon);
      // this.getkategori();
      // this.barang
      this.$toast.success("Berhasil hapus");
    });
  }
}


