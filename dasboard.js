// dashboard.js
document.addEventListener('DOMContentLoaded', function() {
    fetch('get_laptops.php')
        .then(response => response.json())
        .then(data => {
            let laptopList = document.getElementById('laptop_list');
            data.forEach(laptop => {
                let listItem = document.createElement('li');
                listItem.textContent = `${laptop_model} - ${laptop_status}`;
                laptopList.appendChild(listItem);
            });
        });
});
// dashboard.js
document.addEventListener('DOMContentLoaded', function() {
    fetch_laptops();
});

function fetch_laptops() {
    fetch('get_laptops.php')
        .then(response => response.json())
        .then(data => {
            display_laptop_list(data);
        });
}

function display_laptop_list(laptops) {
    let laptop_list = document.getElementById('laptop_list');
    laptops.forEach(function(laptop) {
        let list_item = document.createElement('li');
        list_item.textContent = `${laptop.model} - ${laptop.status}`;
        laptop_list.appendChild(list_item);
    });
}
