import {  Popup } from 'react-leaflet';

export default function( propos ) {
    const object = propos.object;
    return (
        <Popup className="d-block d-lg-no2ne">
            <h3 className="mb-3 text-center text-dark-primary">
                {object?.nom}
            </h3>
            <p className="m-0 p-0 text-center text-dark-primary">
                {object?.telephone}
            </p>
            <p className="m-0 p-0 text-center text-dark-primary">
                {object?.rue}
                <br/>
                {object?.localite}
            </p>
            <p className=" m-0 p-0 text-center text-dark-primary">
                {object?.email}
            </p>
            <a
                href={object?.url}
                target="_blank"
                className="mt-2 btn btn-outline-success m-0 p-0 text-center d-block"
            >
                Consulter la fiche
            </a>
            <a
                className="btn btn-outline-primary mt-2 m-0 p-0 text-center d-block"
                target="_blank"
                href={`https://www.google.com/maps/search/?api=1&query=${object.latitude},${object.longitude}`}
            >
                Itineraire
            </a>
        </Popup> );
};
