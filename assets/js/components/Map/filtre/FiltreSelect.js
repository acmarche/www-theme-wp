function FiltreSelect( filtres, setMarkerData ) {
    console.log( filtres );
    return (
        <>
            <div className="d-block d-lg-none pr-12px border border-dark-primary">
                <select onChange={setMarkerData} name="tabs" id="tab-select" className="fs-short-3 ff-semibold">
                    <optgroup label="Culture">
                        <option value="1-1" selected>Bibliothèque</option>
                        <option value="1-2">Cinéma</option>
                        <option value="1-3">Musées</option>
                        <option value="1-4">Statues / Sculptures</option>
                    </optgroup>
                    <optgroup label="Enfance">
                        <option value="2-1">Accueillantes</option>
                        <option value="2-2">Aires de jeux / Parcs</option>
                    </optgroup>
                    <optgroup label="Enseignement">
                        <option value="3-1">Artistique</option>
                        <option value="3-2">Maternel / Primaire</option>
                        <option value="3-3">Secondaire</option>
                        <option value="3-4">Supérieur</option>
                    </optgroup>
                    <optgroup label="Environnement">
                        <option value="4-1">Bulles à verres</option>
                        <option value="4-2">Bulles à vêtements</option>
                    </optgroup>
                    <optgroup label="Horéca">
                        <option value="5-1">Brasseries / Bars</option>
                        <option value="5-2">Camping</option>
                        <option value="5-3">Chambres dhôtes</option>
                        <option value="5-4">Friteries / Snacks / Sandwicheries</option>
                        <option value="5-5">Gîtes / Meublés de tourisme</option>
                        <option value="5-6">Glaciers / Tea rooms</option>
                        <option value="5-7">Hôtels</option>
                        <option value="5-8">Restaurants</option>
                    </optgroup>
                    <optgroup label="Infrastructure">
                        <option value="6-1">Cimetières</option>
                        <option value="6-2">Salles communales</option>
                    </optgroup>
                    <optgroup label="Mobilité">
                        <option value="7-1">Balade des petits pieds</option>
                        <option value="7-2">Parkings</option>
                        <option value="7-3">Pistes cyclables</option>
                        <option value="7-4">Travaux</option>
                        <option value="7-5">Parkings à vélos</option>
                    </optgroup>
                    <optgroup label="Santé">
                        <option value="8-1">Dentistes</option>
                        <option value="8-2">Hôpital</option>
                        <option value="8-3">Kinéthérapeutes</option>
                        <option value="8-4">Médecins généralistes</option>
                        <option value="8-5">Mutuelles</option>
                        <option value="8-6">Pharmacies</option>
                        <option value="8-7">Vétérinaires</option>
                    </optgroup>
                    <optgroup label="Sport">
                        <option value="9-1">Aérobic</option>
                        <option value="9-2">Arts martiaux</option>
                        <option value="9-3">Athlétisme</option>
                        <option value="9-4">Attelages</option>
                        <option value="9-5">Badminton</option>
                        <option value="9-6">Basket-ball</option>
                        <option value="9-7">Billards</option>
                        <option value="9-8">Bowling</option>
                        <option value="9-9">Course dorientation</option>
                        <option value="9-10">Cyclisme / VTT</option>
                        <option value="9-11">Danse</option>
                        <option value="9-12">Échecs</option>
                        <option value="9-13">Équitation</option>
                        <option value="9-14">Escalade</option>
                        <option value="9-15">Escrime</option>
                        <option value="9-16">Football</option>
                        <option value="9-17">Gymnastique</option>
                        <option value="9-18">Hébertisme</option>
                        <option value="9-19">Canöe / Kayak</option>
                        <option value="9-20">Locations salles multisports</option>
                        <option value="9-21">Marche</option>
                        <option value="9-22">Football en salle</option>
                        <option value="9-23">Multisports</option>
                        <option value="9-24">Musculation</option>
                        <option value="9-25">Natation</option>
                        <option value="9-26">Pétanque</option>
                        <option value="9-27">Pêche</option>
                        <option value="9-28">Plongée</option>
                        <option value="9-29">Réadaptation sportive</option>
                        <option value="9-30">Rugby</option>
                        <option value="9-31">Spéléologie</option>
                        <option value="9-32">Sports moteurs</option>
                        <option value="9-33">Squash</option>
                        <option value="9-34">Step</option>
                        <option value="9-35">Tennis</option>
                        <option value="9-36">Tennis de table</option>
                        <option value="9-37">Tir</option>
                        <option value="9-38">Tir à larc</option>
                        <option value="9-39">Randonnée / Trekking</option>
                        <option value="9-40">Volley-ball</option>
                        <option value="9-41">Yoga / Développement personnel</option>
                        <option value="9-42">Base-ball</option>
                        <option value="9-43">Jogging / Trail</option>
                        <option value="9-44">Hockey</option>
                        <option value="9-45">Padel</option>
                    </optgroup>
                    <optgroup label="Wifi gratuit">
                        <option value="10-1">Réseau Wifi4EU</option>
                    </optgroup>
                </select>
            </div>
        </>
    );
}

export default FiltreSelect;
