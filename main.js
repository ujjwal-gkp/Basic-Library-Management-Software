const all_frames = [document.getElementById("dashboard"), document.getElementById("borrow_book"), document.getElementById("return_book"), document.getElementById("view_book"), document.getElementById("new_stock"), document.getElementById("add_book"), document.getElementById("view_student"), document.getElementById("add_student")];
const all_menu = [document.getElementById("home"), document.getElementById("manage_book"), document.getElementById("manage_student")];
var current_frame = all_frames[0];
var current_menu = all_menu[0];

function change_frame(frame_num) {
    current_frame.style.display = 'none';
    all_frames[frame_num].style.display = 'block';
    current_frame = all_frames[frame_num];
}
function change_menu(menu_num) {
    current_menu.style.display = 'none';
    all_menu[menu_num].style.display = 'block';
    current_menu = all_menu[menu_num];
}