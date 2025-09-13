document.getElementById("increment").addEventListener("click", function () {
    let itemNumInput = document.getElementById("item_num");// 数量変更欄(input要素)を変数に代入
    let currentValue = parseInt(itemNumInput.value);// 数量変更欄の値を数値に変換して変数に代入
    if (currentValue < 10) { // 最低数量を1に制限
        itemNumInput.value = currentValue + 1;
    }
});

document.getElementById("decrement").addEventListener("click", function () {
    let itemNumInput = document.getElementById("item_num");
    let currentValue = parseInt(itemNumInput.value);
    if (currentValue > 1) { // 最低数量を1に制限
        itemNumInput.value = currentValue - 1;
    }
});