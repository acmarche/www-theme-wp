function SwitchView( propos ) {
    const { setView } = propos;

    const handleBtn = ( object ) => {
        setView( object );
    };

    return (
        <>
            <input type="radio" id="btn_list_view" name="view"
                onChange={() => handleBtn( 'list' )}/>
            <span
                className="d-flex align-items-center justify-content-center w-32px h-32px position-absolute top-16px right-48px z-30 icon_custom">
                <i className="i-list w-18px h-18px bg-size-auto"></i>
            </span>
            <input type="radio" id="btn_map_view" name="view"
                onChange={() => handleBtn( 'map' )}/>
            <span
                className="d-flex align-items-center justify-content-center w-32px h-32px position-absolute top-16px right-16px z-30 border-left icon_custom">
                <i className="i-map w-18px h-18px bg-size-auto"></i>
            </span>
        </>
    );
}

export default SwitchView;
