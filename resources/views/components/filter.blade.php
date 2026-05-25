@props(['placeholder'])
<div class="filter-wrapper">
    <div class="filter-bar">
        <input type="text" id="search" placeholder="{{ $placeholder }}">
        <select name="style-select" id="style-select">
            <option value="">-- Válassz --</option>
            @foreach($styles as $style)
                <option value="{{ $style->name }}">{{ $style->name }}</option>
            @endforeach
        </select>
        <div class="close-icon close-icon-js">
            <i class="fa-solid fa-x"></i>
        </div>
    </div>

    <div class="filter-icon filter-icon-js active">
        <i class="fas fa-search"></i>
    </div>

</div>