export { submitData };
function submitData(data) {
    var form = document.getElementsByTagName("body")[0].appendChild(document.createElement("form"));
    form.action = "";
    form.method = "POST";
    let addData = (name, value) => {
        let input = form.appendChild(document.createElement("input"));
        input.name = name;
        input.value = value;
        return input;
    };
    data.map((item) => addData(item.key, item.value));
    form.submit();
}
