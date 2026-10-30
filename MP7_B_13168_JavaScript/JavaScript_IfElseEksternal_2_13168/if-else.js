var iTotal;
var skupon;

iTotal = prompt("Masukkan total belanja (dalam ribu rupiah).", 0);
skupon = prompt("Punya kupon? (Y)a atau (T)idak", "Y");

if (iTotal >= 200) {
    if (skupon == "Y") {
        alert("Diskon 20% dan gratis ongkir");
    } else {
        alert("Diskon 10% dan gratis ongkir");
    }
} else {
    if (skupon == "Y") {
        alert("Diskon 10%");
    } else {
        alert("Tidak ada diskon");
    }
}