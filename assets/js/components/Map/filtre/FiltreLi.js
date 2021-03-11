function FiltreLi( filtres, setMarkerData ) {
    return (
        <>
            <ul className="d-none d-lg-block border-bottom border-default">
                <li className="border-top border-default object-sublist">
                    <input type="radio" id="list_element01" name="list_element"/>
                    <span className="icon_custom"><i
                        className="i-book w-22px h-22px mr-16px bg-size-auto"></i>Culture</span>
                    <ul>
                        <li>
                            <input type="radio" id="sublist_element1-1" name="sublist_element"/>
                            <span>Bibliothèque</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element1-2" name="sublist_element"/>
                            <span>Cinéma</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element1-3" name="sublist_element"/>
                            <span>Musées</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element1-4" name="sublist_element"/>
                            <span>Statues / Sculptures</span>
                        </li>
                    </ul>
                </li>
                <li className="border-top border-default object-sublist">
                    <input type="radio" id="list_element02" name="list_element"/>
                    <span className="icon_custom"><i
                        className="i-beach-ball w-22px h-22px mr-16px bg-size-auto"></i>Enfance</span>
                    <ul>
                        <li>
                            <input type="radio" id="sublist_element2-1" name="sublist_element"/>
                            <span>Accueillantes</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element2-2" name="sublist_element"/>
                            <span>Aires de jeux / Parcs</span>
                        </li>
                    </ul>
                </li>
                <li className="border-top border-default object-sublist">
                    <input type="radio" id="list_element03" name="list_element"/>
                    <span className="icon_custom"><i
                        className="i-school w-22px h-22px mr-16px bg-size-auto"></i>Enseignement</span>
                    <ul>
                        <li>
                            <input type="radio" id="sublist_element3-1" name="sublist_element"/>
                            <span>Artistique</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element3-2" name="sublist_element"/>
                            <span>Maternel / Primaire</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element3-3" name="sublist_element"/>
                            <span>Secondaire</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element3-4" name="sublist_element"/>
                            <span>Supérieur</span>
                        </li>
                    </ul>
                </li>
                <li className="border-top border-default object-sublist">
                    <input type="radio" id="list_element04" name="list_element"/>
                    <span className="icon_custom"><i
                        className="i-leaf w-22px h-22px mr-16px bg-size-auto"></i>Environnement</span>
                    <ul>
                        <li>
                            <input type="radio" id="sublist_element4-1" name="sublist_element"/>
                            <span>Bulles à verres</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element4-2" name="sublist_element"/>
                            <span>Bulles à vêtements</span>
                        </li>
                    </ul>
                </li>
                <li className="border-top border-default object-sublist">
                    <input type="radio" id="list_element05" name="list_element"/>
                    <span className="icon_custom"><i
                        className="i-flatware w-22px h-22px mr-16px bg-size-auto"></i>Horéca</span>
                    <ul>
                        <li>
                            <input type="radio" id="sublist_element5-1" name="sublist_element"/>
                            <span>Brasseries / Bars</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element5-2" name="sublist_element"/>
                            <span>Camping</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element5-3" name="sublist_element"/>
                            <span>Chambres dhôtes</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element5-4" name="sublist_element"/>
                            <span>Friteries / Snacks / Sandwicheries</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element5-5" name="sublist_element"/>
                            <span>Gîtes / Meublés de tourisme</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element5-6" name="sublist_element"/>
                            <span>Glaciers / Tea rooms</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element5-7" name="sublist_element"/>
                            <span>Hôtels</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element5-8" name="sublist_element"/>
                            <span>Restaurants</span>
                        </li>
                    </ul>
                </li>
                <li className="border-top border-default object-sublist">
                    <input type="radio" id="list_element06" name="list_element"/>
                    <span className="icon_custom"><i
                        className="i-board w-22px h-22px mr-16px bg-size-auto"></i>Infrastructures</span>
                    <ul>
                        <li>
                            <input type="radio" id="sublist_element6-1" name="sublist_element"/>
                            <span>Cimetières</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element6-2" name="sublist_element"/>
                            <span>Salles communales</span>
                        </li>
                    </ul>
                </li>
                <li className="border-top border-default object-sublist">
                    <input type="radio" id="list_element07" name="list_element"/>
                    <span className="icon_custom"><i
                        className="i-bus w-22px h-22px mr-16px bg-size-auto"></i>Mobilité</span>
                    <ul>
                        <li>
                            <input type="radio" id="sublist_element7-1" name="sublist_element"/>
                            <span>Balade des petits pieds</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element7-2" name="sublist_element"/>
                            <span>Parkings</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element7-3" name="sublist_element"/>
                            <span>Pistes cyclables</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element7-4" name="sublist_element"/>
                            <span>Travaux</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element7-5" name="sublist_element"/>
                            <span>Parkings à vélos</span>
                        </li>
                    </ul>
                </li>
                <li className="border-top border-default object-sublist">
                    <input type="radio" id="list_element08" name="list_element"/>
                    <span className="icon_custom"><i
                        className="i-healthcase w-22px h-22px mr-16px bg-size-auto"></i>Santé</span>
                    <ul>
                        <li>
                            <input type="radio" id="sublist_element8-1" name="sublist_element"/>
                            <span>Dentistes</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element8-2" name="sublist_element"/>
                            <span>Hôpital</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element8-3" name="sublist_element"/>
                            <span>Kinésithérapeutes</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element8-4" name="sublist_element"/>
                            <span>Médecins généralistes</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element8-5" name="sublist_element"/>
                            <span>Mutuelles</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element8-6" name="sublist_element"/>
                            <span>Pharmacies</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element8-7" name="sublist_element"/>
                            <span>Vétérinaires</span>
                        </li>
                    </ul>
                </li>
                <li className="border-top border-default object-sublist">
                    <input type="radio" id="list_element09" name="list_element"/>
                    <span className="icon_custom"><i
                        className="i-chrono w-22px h-22px mr-16px bg-size-auto"></i>Sport</span>
                    <ul>
                        <li>
                            <input type="radio" id="sublist_element9-1" name="sublist_element"/>
                            <span>Aérobic</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-2" name="sublist_element"/>
                            <span>Arts martiaux</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-3" name="sublist_element"/>
                            <span>Athlétisme</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-4" name="sublist_element"/>
                            <span>Attelages</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-5" name="sublist_element"/>
                            <span>Badminton</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-6" name="sublist_element"/>
                            <span>Basket-ball</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-7" name="sublist_element"/>
                            <span>Billards</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-8" name="sublist_element"/>
                            <span>Bowling</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-9" name="sublist_element"/>
                            <span>Course dorientation</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-10" name="sublist_element"/>
                            <span>Cyclisme / VTT</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-11" name="sublist_element"/>
                            <span>Danse</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-12" name="sublist_element"/>
                            <span>Échecs</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-13" name="sublist_element"/>
                            <span>Équitation</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-14" name="sublist_element"/>
                            <span>Escalade</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-15" name="sublist_element"/>
                            <span>Escrime</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-16" name="sublist_element"/>
                            <span>Football</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-17" name="sublist_element"/>
                            <span>Gymnastique</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-18" name="sublist_element"/>
                            <span>Hébertisme</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-19" name="sublist_element"/>
                            <span>Canöe / Kayak</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-20" name="sublist_element"/>
                            <span>Locations salles multisports</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-21" name="sublist_element"/>
                            <span>Marche</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-22" name="sublist_element"/>
                            <span>Football en salle</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-23" name="sublist_element"/>
                            <span>Multisports</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-24" name="sublist_element"/>
                            <span>Musculation</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-25" name="sublist_element"/>
                            <span>Natation</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-26" name="sublist_element"/>
                            <span>Pétanque</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-27" name="sublist_element"/>
                            <span>Pêche</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-28" name="sublist_element"/>
                            <span>Plongée</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-29" name="sublist_element"/>
                            <span>Réadaptation sportive</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-30" name="sublist_element"/>
                            <span>Rugby</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-31" name="sublist_element"/>
                            <span>Spéléologie</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-32" name="sublist_element"/>
                            <span>Sports moteurs</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-33" name="sublist_element"/>
                            <span>Squash</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-34" name="sublist_element"/>
                            <span>Step</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-35" name="sublist_element"/>
                            <span>Tennis</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-36" name="sublist_element"/>
                            <span>Tennis de table</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-37" name="sublist_element"/>
                            <span>Tir</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-38" name="sublist_element"/>
                            <span>Tir à larc</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-39" name="sublist_element"/>
                            <span>Randonnée / Trekking</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-40" name="sublist_element"/>
                            <span>Volley-ball</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-41" name="sublist_element"/>
                            <span>Yoga / Développement personnel</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-42" name="sublist_element"/>
                            <span>Base-ball</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-43" name="sublist_element"/>
                            <span>Jogging / Trail</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-44" name="sublist_element"/>
                            <span>Hockey</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element9-45" name="sublist_element"/>
                            <span>Padel</span>
                        </li>
                    </ul>
                </li>
                <li className="border-top border-default object-sublist">
                    <input type="radio" id="list_element08" name="list_element"/>
                    <span className="icon_custom"><i
                        className="i-wifi w-22px h-22px mr-16px bg-size-auto"></i>Wifi gratuit</span>
                    <ul>
                        <li>
                            <input type="radio" id="sublist_element10-1" name="sublist_element"/>
                            <span>Réseau Wifi4EU</span>
                        </li>
                    </ul>
                </li>
            </ul>
        </>
    );
}

export default FiltreLi;
