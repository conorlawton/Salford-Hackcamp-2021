<div id="searchSection">

    <form action="Search_Bar_Controller.php" method="POST">

        <!--Search Bar-->
        <div class="input-group input-group-lg" id="searchBar">
            <input class="input-group-text" id="searchBarProper" type="text" name="searchBar"><br>
            <input id="searchSubmit" type="submit" name="submitSearchButton"><br>
        </div>

        <div id="filters">

            <p>Search By:</p>

            <div id="radioButtons">
                <!--Radio Button - 1 year-->
                <input id="Radio_1_Year" type="radio" name="searchRadio" value="1" checked="checked">
                <label for="Radio_1_Year">1 Year</label>

                <!--Radio Button - 6 months-->
                <input id="Radio_6_Months" type="radio" name="searchRadio" value="2">
6                <label for="Radio_6_Months">6 Months</label>

                <!--Radio Button - 1 month-->
                <input id="Radio_1_Month" type="radio" name="searchRadio" value="3">
                <label for="Radio_1_Month">1 Month</label>

                <!--Radio Button - 1 week-->
                <input id="Radio_1_week" type="radio" name="searchRadio" value="4">
                <label for="Radio_1_week">1 Week</label>
            </div>

            <!--Checkbox-->
            <div class="form-check form-switch" id="switch">
                <input class="form-check-input" id="flexSwitchCheckChecked" type="checkbox" name="searchCheckbox" value="true">
                <label for="Check_If_Resolved">Resolved</label>
            </div>

        </div>

    </form>

</div>