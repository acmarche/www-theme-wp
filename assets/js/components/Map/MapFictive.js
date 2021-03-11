function MapFictive( ) {
    return (
        <>
            <div
                className="d-flex w-64px h-32px position-absolute top-16px right-16px z-20 shadow-sm-1">
            </div>
            <input type="radio" id="btn_list_view" name="view"/>
            <span
                className="d-flex align-items-center justify-content-center w-32px h-32px position-absolute top-16px right-48px z-30 icon_custom">
                <i className="i-list w-18px h-18px bg-size-auto"></i>
            </span>
            <input type="radio" id="btn_map_view" name="view" checked/>
            <span
                className="d-flex align-items-center justify-content-center w-32px h-32px position-absolute top-16px right-16px z-30 border-left icon_custom">
                <i className="i-map w-18px h-18px bg-size-auto"></i>
            </span>
            <div
                className="d-flex flex-column w-32px position-absolute top-16px left-16px z-20 shadow-sm-1">
                <span
                    className="d-flex align-items-center justify-content-center w-32px h-32px bg-white icon_custom">
                    <i className="i-search-plus w-18px h-18px bg-size-auto"></i>
                </span>
                <span
                    className="d-flex align-items-center justify-content-center w-32px h-32px bg-white icon_custom border-top">
                    <i className="i-search-less w-18px h-18px bg-size-auto"></i>
                </span>
            </div>
            <img src="https://new.marche.be/wp-content/themes/marchebe/assets/tartine/rsc/img/img_tempo_map.png" alt="tempo"
                className="position-absolute h-100 w-lg-100 h-lg-auto z-10"/>
        </>
    );
}

export default MapFictive;
