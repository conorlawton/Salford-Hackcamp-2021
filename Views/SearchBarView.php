<div id="searchSection">

    <!--<?php //require_once ('../Controllers/search_bar_controller.php');?>-->

    <form action="SearchBar" method="POST">

        <!--Search Bar-->
        <div class="input-group input-group-lg" id="searchBar">
            <input class="input-group-text" id="searchBarProper" type="text" name="searchBar">
            <input id="searchSubmit" type="submit" name="submitSearchButton">
        </div>

        <div id="filters">

            <p>Search For:</p>

            <div id="radioButtons">
                <!--Radio Button - Customer-->
                <input id="Radio_Customer" type="radio" name="searchRadio" value="1" checked="checked">
                <label for="Radio_Customer">Customer</label>

                <!--Radio Button - Problem-->
                <input id="Radio_Problem" type="radio" name="searchRadio" value="2">
                <label for="Radio_Problem">Problem</label>

                <!--Radio Button - Category-->
                <input id="Radio_Category" type="radio" name="searchRadio" value="3">
                <label for="Radio_Category">Category</label>

                <!--Radio Button - Staff-->
                <input id="Radio_Staff" type="radio" name="searchRadio" value="4">
                <label for="Radio_Staff">Colleague</label>
            </div>

            <!--Checkbox-->
            <div class="form-check form-switch" id="switch">
                <input class="form-check-input" id="flexSwitchCheckChecked" type="checkbox" name="searchCheckbox" value="1">
                <label for="Check_If_Resolved">Resolved</label>
            </div>

        </div>

    </form>

</div>