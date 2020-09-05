<?php namespace JATSParser\HTML;

use JATSParser\Back\AbstractReference;
use JATSParser\Back\Individual;
use JATSParser\Back\Collaboration;

class ReferenceMethods {

	public static function extractAuthors(AbstractReference $jatsReference, \DOMElement $domElement): void {
		foreach ($jatsReference->getAuthors() as $key => $author) {
			if (get_class($author) === "JATSParser\Back\Individual") {

				/* @var $author Individual */

				if ($author->getSurname()) {
					$htmlSurname = $domElement->ownerDocument->createTextNode($author->getSurname());
					$domElement->appendChild($htmlSurname);
				}

				if ($author->getGivenNames() && $key + 1 < count($jatsReference->getAuthors())) {
					$htmlGivenName = $domElement->ownerDocument->createTextNode(" " . $author->getGivenNames() . ", ");
					$domElement->appendChild($htmlGivenName);
				} elseif ($author->getGivenNames() && $key + 1 === count($jatsReference->getAuthors())) {
					$htmlGivenName = $domElement->ownerDocument->createTextNode(" " . $author->getGivenNames() . ".");
					$domElement->appendChild($htmlGivenName);
				}
			} elseif (get_class($author) === "JATSParser\Back\Collaboration") {

				/* @var $author Collaboration */
				if ($author->getName() && $key === 0 && $key + 1 === count($jatsReference->getAuthors())) {
					$htmlCollab = $domElement->ownerDocument->createTextNode(trim($author->getName()) . ".");
					$domElement->appendChild($htmlCollab);
				} elseif ($author->getName() && $key === 0 && $key + 1 < count($jatsReference->getAuthors())) {
					$htmlCollab = $domElement->ownerDocument->createTextNode(trim($author->getName()) . ", ");
					$domElement->appendChild($htmlCollab);
				} elseif ($author->getName() && $key + 1 < count($jatsReference->getAuthors())) {
					$htmlCollab = $domElement->ownerDocument->createTextNode(" " . trim($author->getName()) . ", ");
					$domElement->appendChild($htmlCollab);
				} elseif ($author->getName() && $key + 1 === count($jatsReference->getAuthors())) {
					$htmlCollab = $domElement->ownerDocument->createTextNode(" " . trim($author->getName()) . ".");
					$domElement->appendChild($htmlCollab);
				}
			}
		}
	}

	public static function extractLinks (AbstractReference $jatsReference, \DOMElement $domElement): void {
			if ($jatsReference->getUrl() !== "" && !empty($jatsReference->getPubIdType())) {
				$urlLink = $domElement->ownerDocument->createElement('a');
				$urlLink->setAttribute("href", $jatsReference->getUrl());
				$urlLink->nodeValue = "Publisher Full Text";
				$domElement->appendChild($urlLink);

				// $delimeter = $domElement->ownerDocument->createTextNode(' | ');
				// $domElement->appendChild($delimeter);
			} elseif ($jatsReference->getUrl() !== '') {
				$urlLink = $domElement->ownerDocument->createElement('a');
				$urlLink->setAttribute("href", $jatsReference->getUrl());
				$urlLink->nodeValue = "Publisher Full Text";
				$domElement->appendChild($urlLink);
			}
			$doifound=false;
			$pmidfound=false;
			$pmcidfound=false;
			if ($jatsReference->getPubIdType() !== ''){
				$number = 0;
				foreach ($jatsReference->getPubIdType() as $key => $pubId) {
					if ($key == 'doi') {
						// if ($number > 0) {
						// 	$pmidDelimeter = $domElement->ownerDocument->createTextNode(' | ');
						// 	$domElement->appendChild($pmidDelimeter);
						// }
						$number += 1;
						$doiLink = $domElement->ownerDocument->createElement('a');
						$doiLink->setAttribute("href", $pubId);
						$doiLink->setAttribute("target", '_blank'); //aggiunto
						// guidelines CrossRef
						$doiLink->nodeValue = $pubId;
						//$doiLink->nodeValue = "CrossRef";
						$domElement->appendChild($doiLink);
						$doifound=true;	//aggiunto per gestione doi dalle referenze se necessario
					} elseif ($key == "pmid") {
						// if ($number > 0) {
						// 	$pmidDelimeter = $domElement->ownerDocument->createTextNode(' | ');
						// 	$domElement->appendChild($pmidDelimeter);
						// }
						$number += 1;
						$pmidLink = $domElement->ownerDocument->createElement('a');
						$pmidLink->setAttribute("href", $pubId);
						$pmidLink->setAttribute("target", '_blank'); //aggiunto
						$pmidLink->nodeValue = "PubMed";
						$domElement->appendChild($pmidLink);
						$pmidfound=true;	//aggiunto per gestione pmid dalle referenze se necessario
					} elseif ($key == "pmcid") {
						// if ($number > 0) {
						// 	$pmidDelimeter = $domElement->ownerDocument->createTextNode(' | ');
						// 	$domElement->appendChild($pmidDelimeter);
						// }
						$number += 1;
						$pmcidLink = $domElement->ownerDocument->createElement('a');
						$pmcidLink->setAttribute("href", $pubId);
						$pmcidLink->setAttribute("target", '_blank'); //aggiunto
						$pmcidLink->nodeValue = "PubMed Central";
						$domElement->appendChild($pmcidLink);
						$pmcidfound=true;	//aggiunto per gestione pmcid dalle referenze se necessario
					}
				}

			}

			// by Massimo Senna 
			// aggiungo tag provvisorio doi,pmid,pmcid per provare a ricavarlo dalle referenze di OJS  


			// se non ho trovato il doi e/o pmid e/o pmcid nel file xml, aggiungi dei segnaposto da usare dopo
			if(!$doifound){
				// if ($number > 0) {
				// 	$pmidDelimeter = $domElement->ownerDocument->createTextNode(' | ');
				// 	$domElement->appendChild($pmidDelimeter);
				// }
						$number += 1;
						$doiLink = $domElement->ownerDocument->createElement('extdoi');
						$doiLink->setAttribute("id", 'doi'.$jatsReference->getId());
						$domElement->appendChild($doiLink);
			}
			if(!$pmidfound){
				// if ($number > 0) {
				// 	$pmidDelimeter = $domElement->ownerDocument->createTextNode(' | ');
				// 	$domElement->appendChild($pmidDelimeter);
				// }
						$number += 1;
						$doiLink = $domElement->ownerDocument->createElement('extpmid');
						$doiLink->setAttribute("id", 'pmid'.$jatsReference->getId());
						$domElement->appendChild($doiLink);
			}
			if(!$pmcidfound){
				// if ($number > 0) {
				// 	$pmidDelimeter = $domElement->ownerDocument->createTextNode(' | ');
				// 	$domElement->appendChild($pmidDelimeter);
				// }
						$number += 1;
						$doiLink = $domElement->ownerDocument->createElement('extpmcid');
						$doiLink->setAttribute("id", 'pmcid'.$jatsReference->getId());
						$domElement->appendChild($doiLink);
			}
			// by Massimo Senna 
			// aggiungo link a googlescholar 
			// https://scholar.google.com/scholar_lookup?author=E+Lefran%C3%A7ais&author=G+Ortiz-Mu%C3%B1oz&author=A+Caudrillier&title=The+lung+is+a+site+of+platelet+biogenesis+and+a+reservoir+for+haematopoietic+progenitors&publication_year=2017&journal=Nature&volume=544&pages=105-109

			// if ($number > 0) {
			// 	$pmidDelimeter = $domElement->ownerDocument->createTextNode(' | ');
			// 	$domElement->appendChild($pmidDelimeter);
			// }

			$gsidLink = $domElement->ownerDocument->createElement('a');
			$scholarUrl='https://scholar.google.com/scholar_lookup';
			$auth_cnt=0;
			foreach ($jatsReference->getAuthors() as $key => $author) {
				if (get_class($author) === "JATSParser\Back\Individual") {
					$a=$author->getSurname().' '.$author->getGivenNames();
					if($a){
						if($auth_cnt==0){
							$scholarUrl.='?author='.$a;
						}else{
							$scholarUrl.='&author='.$a;
						}
					}
					$auth_cnt+=1;
				} elseif (get_class($author) === "JATSParser\Back\Collaboration") {
					$a=$author->getName();
					if($a){
						if($auth_cnt==0){
							$scholarUrl.='?author='.$a;
						}else{
							$scholarUrl.='&author='.$a;
						}
					}

					$auth_cnt+=1;
				}
			}
			if($auth_cnt==0){
				$scholarUrl.='?title=';
			}else{
				$scholarUrl.='&title=';
			}

			$scholarUrl.=$jatsReference->getTitle();

			$scholarUrl=str_replace(' ','+',$scholarUrl);
			// aggiungo una classe per il link scholar
			$gsidLink->setAttribute("class", "artref-scholar-link");
			$gsidLink->setAttribute("href", $scholarUrl);
			$gsidLink->setAttribute("target", '_blank'); //aggiunto
			$gsidLink->nodeValue = "Google Scholar";

			// $pmidDelimeter = $domElement->ownerDocument->createElement('span');
			// $pmidDelimeter->nodeValue='|';
			// $pmidDelimeter->setAttribute("class", 'references-link-delimeter');
			// $domElement->appendChild($pmidDelimeter);

			$domElement->appendChild($gsidLink);

	}

	


	public static function extractEditors(AbstractReference $jatsReference, \DOMElement $domElement) {
		foreach ($jatsReference->getEditors() as $key => $author) {
			if (get_class($author) === "JATSParser\Back\Individual") {

				/* @var $author Individual */

				if ($author->getSurname()) {
					$htmlSurname = $domElement->ownerDocument->createTextNode($author->getSurname());
					$domElement->appendChild($htmlSurname);
				}

				if ($author->getGivenNames() && $key + 1 < count($jatsReference->getEditors())) {
					$htmlGivenName = $domElement->ownerDocument->createTextNode(" " . $author->getGivenNames() . ", ");
					$domElement->appendChild($htmlGivenName);
				} elseif ($author->getGivenNames() && $key + 1 === count($jatsReference->getEditors())) {
					$htmlGivenName = $domElement->ownerDocument->createTextNode(" " . $author->getGivenNames() . ".");
					$domElement->appendChild($htmlGivenName);
				}
			} elseif (get_class($author) === "JATSParser\Back\Collaboration") {

				/* @var $author Collaboration */
				if ($author->getName() && $key === 0 && $key + 1 === count($jatsReference->getEditors())) {
					$htmlCollab = $domElement->ownerDocument->createTextNode(trim($author->getName()) . ".");
					$domElement->appendChild($htmlCollab);
				} elseif ($author->getName() && $key === 0 && $key + 1 < count($jatsReference->getEditors())) {
					$htmlCollab = $domElement->ownerDocument->createTextNode(trim($author->getName()) . ", ");
					$domElement->appendChild($htmlCollab);
				} elseif ($author->getName() && $key + 1 < count($jatsReference->getEditors())) {
					$htmlCollab = $domElement->ownerDocument->createTextNode(" " . trim($author->getName()) . ", ");
					$domElement->appendChild($htmlCollab);
				} elseif ($author->getName() && $key + 1 === count($jatsReference->getEditors())) {
					$htmlCollab = $domElement->ownerDocument->createTextNode(" " . trim($author->getName()) . ".");
					$domElement->appendChild($htmlCollab);
				}
			}
		}
	}
}
