import { useMap } from 'react-leaflet';
import { createContext, useContext } from 'react';
import useGeolocation from './hooks/useGeolocation';

function ZoomButtons() {
    const Context = createContext();
    const { map } = useContext( Context );
    console.log( map );
    const showMyLocation = () => {
        console.log( `hihi${map}` );
    };

    return (
        <>
            <div
                className="d-flex flex-column w-32px position-absolute top-16px left-16px z-20 shadow-sm-1">
                <span onClick={() => showMyLocation()}
                    className="d-flex align-items-center justify-content-center w-32px h-32px bg-white icon_custom">
                    <i className="i-search-plus w-18px h-18px bg-size-auto"></i>
                </span>
                <span onClick={() => showMyLocation()}
                    className="d-flex align-items-center justify-content-center w-32px h-32px bg-white icon_custom border-top">
                    <i className="i-search-less w-18px h-18px bg-size-auto"></i>
                </span>
            </div>
        </>
    );
}

export default ZoomButtons;
