<!DOCTYPE html>
<html>
<title>HTML Tutorial</title>
<body>

<h1>This is a heading</h1>
<p>This is a paragraph.</p>

    <div class="container">
    <div class="light">
        <h3>Toggle Switches (Light)</h3>
        <div class="switch">
        <input id="toggle1" class="toggle" checked="true" type="checkbox">
        <label for="toggle1"></label>
        <span class="switch-label">checked</span>
        </div>
        <div class="switch">
        <input id="toggle2" class="toggle" type="checkbox">
        <label for="toggle2"></label>
        <span class="switch-label">UnChecked Toggle</span>
        </div>
        <div class="switch">
        <input id="toggle6" class="toggle" type="checkbox" disabled="disabled">
        <label for="toggle6"></label>
        <span class="switch-label">Disabled</span>
        </div>
        <br><br>
        <br><br>
        <ul>
        <h3>Checkbox Examples</h3>
        <li>
            <input id="checkbox1" class="checkbox" type="checkbox">
            <label for="checkbox1">Label for checkbox 1 here in the flesh Label for checkbox 1 here in the flesh Label for checkbox 1 here in the flesh</label>
        </li>
        <li>
            <input id="checkbox2" class="checkbox" type="checkbox" checked="true">
            <label for="checkbox2">Label for 2</label>
        </li>
        <li>
            <input id="checkbox3" class="checkbox" type="checkbox">
            <label for="checkbox3">Label for checkbox 1 here in the flesh Label for checkbox 1 here in the flesh Label for checkbox 1 here in the flesh</label>
        </li>
        <li>
            <input id="checkbox4" class="checkbox" type="checkbox" disabled="true">
            <label for="checkbox4">Label for 4 (disabled)</label>
        </li>
        </ul>
        <ul>
        <h3>Radio Buttons</h3>
        <li>
            <input id="radio1" class="radio" type="radio" name="radio">
            <label for="radio1">Label for checkbox 1 here in the flesh Label for checkbox 1 here in the flesh Label for checkbox 1 here in the flesh</label>
        </li>
        <li>
            <input id="radio2" class="radio" type="radio" name="radio" checked="true">
            <label for="radio2">Label for 2</label>
        </li>
        <li>
            <input id="radio3" class="radio" type="radio" name="radio">
            <label for="radio3">Label for checkbox 1 here in the flesh Label for checkbox 1 here in the flesh Label for checkbox 1 here in the flesh</label>
        </li>
        <li>
            <input id="radio4" class="radio" type="radio" name="radio" disabled="true">
            <label for="radio4">Label for 4 (disabled)</label>
        </li>
        </ul>
    </div>
    <div class="dark">
        <div class="switch">
        <input id="toggle3" class="toggle" checked="checked" type="checkbox">
        <label for="toggle3"></label>
        </div>
        <div class="switch">
        <input id="toggle4" class="toggle" type="checkbox">
        <label for="toggle4"></label>
        <span class="switch-label">Label</span>
        </div>
        <div class="switch">
        <input id="toggle5" class="toggle" type="checkbox" disabled="disabled">
        <label for="toggle5"></label>
        </div>
            <ul>
        <li>
            <input id="checkboxa" class="checkbox" type="checkbox">
            <label for="checkboxa">Label for checkbox 1 here in the flesh Label for checkbox 1 here in the flesh Label for checkbox 1 here in the flesh</label>
        </li>
        <li>
            <input id="checkboxb" class="checkbox" type="checkbox" checked="true">
            <label for="checkboxb">Label for 2</label>
        </li>
        <li>
            <input id="checkboxc" class="checkbox" type="checkbox" disabled="true">
            <label for="checkboxc">Label for 4 (disabled)</label>
        </li>
        </ul>
        <ul>
        <li>
            <input id="radioa" class="radio" type="radio" name="radio">
            <label for="radioa">Label for checkbox 1 here in the flesh Label for checkbox 1 here in the flesh Label for checkbox 1 here in the flesh</label>
        </li>
        <li>
            <input id="radiob" class="radio" type="radio" name="radio" checked="true">
            <label for="radiob">Label for 2</label>
        </li>
        <li>
            <input id="radioc" class="radio" type="radio" name="radio" disabled="true">
            <label for="radioc">Label for 4 (disabled)</label>
        </li>
        </ul>
    </div>
    </div>



</body>
</html>




