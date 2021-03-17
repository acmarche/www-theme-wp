import {  Popup } from 'react-leaflet';

export default function( propos ) {
    const object = propos.object;

    function createMarkup() {
        return { __html: object?.description };
    }

    return (
        <Popup className="d-block d-lg-no2ne">
            <h3 className="mb-3 text-center text-dark-primary">
                {object?.nom}
            </h3>
            <p className="m-0 p-0 text-center text-dark-primary" dangerouslySetInnerHTML={createMarkup()}/>

            <a
                className="btn btn-outline-primary mt-2 m-0 p-0 text-center d-block"
                target="_blank"
                href={`https://www.google.com/maps/search/?api=1&query=${object.latitude},${object.longitude}`}
            >
                Itineraire
            </a>
        </Popup> );
};
