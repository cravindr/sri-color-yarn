<style>

    .tile {
        width:160px;
        height:180px;
        border-radius:4px;
        box-shadow: 2px 2px 4px 0 rgba(0,0,0,0.15);
        margin-top:20px;
        margin-left:20px;
        float:left;
    }

    .tile.wide {
        width: 340px;
    }

    .tile .header {
        height:120px;
        background-color:#f4f4f4;
        border-radius: 4px 4px 0 0;
        color:white;
        font-weight:300;
    }

    .tile.wide .header .left, .tile.wide .header .right {
        width:160px;
        float:left;
    }

    .tile .header .count {
        font-size: 48px;
        text-align:center;
        padding:10px 0 0;
    }

    .tile .header .title {
        font-size: 20px;
        text-align:center;
    }

    .tile {
        height:60px;
        border-radius: 0 0 4px 4px;
        color:#333333;
        background-color:white;
    }

    .tile .title {
        text-align:center;
        font-size:20px;
        padding-top:2%;
    }

    .tile.wide .title {
        padding:4%;
    }

    .tile.job .header {
        background: linear-gradient(to bottom right, #609931, #87bc27);
    }

    .tile.job  {
        color: #609931;
    }

    .tile.resource .header {
        background: linear-gradient(to bottom right, #ef7f00, #f7b200);
    }

    .tile.resource  {
        color: #ef7f00;
    }

    .tile.quote .header {
        background: linear-gradient(to bottom right, #1f6abb, #4f9cf2);
    }

    .tile.quote  {
        color: #1f6abb;
    }

    .tile.invoice .header {
        background: linear-gradient(to bottom right, #0aa361, #1adc88);
    }

    .tile.invoice  {
        color: #0aa361;
    }
</style>


<!-- top tiles -->
<div class="container">
    <div class="tile job">
        <div class="header">
            <div class="count">1</div>
            <div class="title">Jobs</div>
        </div>
    </div>
    <div class="tile job">
        <div class="header">
            <div class="count">4</div>
            <div class="title">Jobs</div>
        </div>
        <div class="body">
            <div class="title">Awaiting Scope of Works</div>
        </div>
    </div>
    <div class="tile wide resource">
        <div class="header">
            <div class="left">
                <div class="count">2</div>
                <div class="title">Resources</div>
            </div>
            <div class="right">
                <div class="count">34</div>
                <div class="title">Jobs Affected</div>
            </div>
        </div>
        <div class="body">
            <div class="title">Resource Availability</div>
        </div>
    </div>
    <div class="tile wide quote">
        <div class="header">
            <div class="left">
                <div class="count">2</div>
                <div class="title">Quotes</div>
            </div>
            <div class="right">
                <div class="count">£2,450</div>
                <div class="title">Total Value</div>
            </div>
        </div>
        <div class="body">
            <div class="title">Quotes Awaiting Approval</div>
        </div>
    </div>
    <div class="tile wide invoice">
        <div class="header">
            <div class="left">
                <div class="count">6</div>
                <div class="title">Invoices</div>
            </div>
            <div class="right">
                <div class="count">£4,876</div>
                <div class="title">Total Value</div>
            </div>
        </div>
        <div class="body">
            <div class="title">Invoices Awaiting Approval</div>
        </div>
    </div>
</div>
<!-- /top tiles -->