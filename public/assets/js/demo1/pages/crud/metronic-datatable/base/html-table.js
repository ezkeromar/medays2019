"use strict";
// Class definition

var KTDatatableHtmlTableDemo = function() {
	// Private functions

	var datatable;

	// demo initializer
	var demo = function() {
		if ($("#html_table").length) {
      datatable = $("#html_table").KTDatatable({
        data: {
          saveState: { cookie: false }
        },
        search: {},
        pagination: false,
        columns: [
          {
            field: "ID",
            title: "#",
            sortable: false,
            width: 20,
            selector: {
              class: "kt-checkbox--solid"
            },
            textAlign: "center"
          },
          {
            field: "Informations personnelles",
            sortable: false,
            width: 250
          },
          {
            field: "Fonction",
            sortable: false,
            autoHide: true
          },
          {
            field: "Pays",
            sortable: false
          },
          {
            field: "Date d'inscription",
            sortable: false
          },
          {
            field: "Motivation",
            sortable: false
          },
          {
            field: "Type",
            title: "Type",
            sortable: false,
            autoHide: false,
            width: 180,
            // callback function support for column rendering
            template: function(row) {
              var types = {
                1: { title: "Standard", class: "kt-badge--presse" },
                2: {
                  title: "Premium sans hébergement",
                  class: " kt-badge--premium"
                },
                3: {
                  title: "Premium avec hébergement",
                  class: " kt-badge--premium"
                },
                4: {
                  1: {
                    title: "Speaker - Niveau 1",
                    class: " kt-badge--premium"
                  },
                  2: {
                    title: "Speaker - Niveau 2",
                    class: " kt-badge--speaker-2"
                  },
                  3: {
                    title: "Speaker - Niveau 3",
                    class: " kt-badge--speaker-3"
                  }
                },
                5: { title: "Conjoint", class: " kt-badge--premium" },
                6: {
                  1: {
                    title: "Délégation - Niveau 1",
                    class: " kt-badge--premium"
                  },
                  2: {
                    title: "Délégation - Niveau 2",
                    class: " kt-badge--speaker-2"
                  },
                  3: {
                    title: "Délégation - Niveau 3",
                    class: " kt-badge--speaker-3"
                  }
                },
                7: { title: "Presse", class: " kt-badge--presse" },
                8: { title: "Partenaire média", class: " kt-badge--media" },
                9: { title: "Sponsor", class: " kt-badge--sponsor" },
                11: {
                  title: "Institut Amadeus",
                  class: " kt-badge--unified-info"
                },
                10: { title: "Organisateur", class: " kt-badge--organisateur" },
                12: {
                  title: "Police / Armée / Gendarmerie",
                  class: " kt-badge--unified-info"
                },
                13: { title: "Sécurité", class: " kt-badge--unified-info" },
                14: { title: "Staff", class: " kt-badge--unified-info" }
              };
              var classe = "";
              var title = "";
              if ((row.Type != 4 && row.Type != 6) || row.Level.length == 0) {
                classe = types[row.Type].class;
                title = types[row.Type].title;
              } else {
                classe = types[row.Type][row.Level].class;
                title = types[row.Type][row.Level].title;
              }
              return (
                '<span class="kt-badge ' +
                classe +
                ' kt-badge--rounded kt-badge--bold kt-badge--inline">' +
                title +
                "</span>"
              );
            }
          },
          {
            field: "OrderDate",
            type: "date",
            sortable: false,
            format: "YYYY-MM-DD"
          },
          {
            field: "Level",
            sortable: false,
            title: "Level"
          },
          {
            field: "Statut",
            title: "Statut",
            sortable: false,
            autoHide: false,
            // callback function support for column rendering
            template: function(row) {
              var status = {
                1: { title: "En attente", state: "danger orrangecolor" },
                2: { title: "Invitation envoyée", state: "primary" },
                3: { title: "Validée", state: "success" },
                4: { title: "Refusée", state: "danger" },
                5: { title: "Désactivé", state: "danger" },
                6: { title: "Demande transport", state: "danger orrangecolor" },
                7: {
                  title: "Attente informations transfert",
                  state: "danger orrangecolor"
                },
                8: { title: "Badge en cours d’édition", state: "danger" },
                9: { title: "Badge édité", state: "success" },
                10: { title: "Badge livré", state: "success" },
                13: { title: "Attente de validation", state: "info" }
              };
              if (status[row.Statut])
                return (
                  '<span class="kt-badge kt-badge--' +
                  status[row.Statut].state +
                  ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' +
                  status[row.Statut].state +
                  '">' +
                  status[row.Statut].title +
                  "</span>"
                );
              return "";
            }
          },
          {
            field: "Actions",
            title: "Actions",
            sortable: false,
            width: 110,
            overflow: "visible",
            autoHide: false,
            template: function(row) {
              let url = "participant/" + row.ID + "/";
              return (
                '\
						<div class="dropdown">\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
                                <i class="flaticon-more-1"></i>\
                            </a>\
							  <div class="dropdown-menu dropdown-menu-right">\
							  	<span class="dropdown-item DataTableVUrl" data-url="' +
                url +
                '1" data-action="Valider"><i class="la la-check-circle"></i> Valider</span>\
							  	' +
                (["2", "4", "8", "6", "3", "9"].includes(row.Type)
                  ? ' <span class="dropdown-item DataTableVUrl" data-url="' +
                    url +
                    '15" data-action="Envoyer Invitation"><i class="la la-check-circle"></i> Envoyer invitation</span>'
                  : "") +
                '\
						    	<span class="dropdown-item DataTableVUrl" data-url="' +
                url +
                '2" data-action="Refuser"><i class="la la-minus-circle"></i> Refuser</span>\
						    	' +
                (window.has_upgrade || window.is_admin
                  ? '<span class="dropdown-item showUpPop" data-id="' +
                    row.ID +
                    '" data-level="' +
                    row.Level +
                    '" data-type="' +
                    row.Type +
                    '" data-toggle="modal" data-target="#kt_modal_6"><i class="la la-thumbs-o-up"></i> Upgrader</span>'
                  : "") +
                '\
						    	<span class="dropdown-item DataTableVUrl" data-url="' +
                url +
                '4" data-action="Livrer le Badge"><i class="la la-credit-card"></i> Livrer le Badge</span>\
						    	<span class="dropdown-item DataTableVUrlNPOP" data-url="' +
                url +
                '5"><i class="la la-edit"></i> Modifier</span>\
						    	' +
                ('<span class="dropdown-item DataTableVUrl" data-url="' +
                  url +
                  '6" data-action="Désactivé"><i class="la la-close"></i> Désactiver</span>') +
                "\
						    	" +
                (window.is_admin || window.has_delete
                  ? '<span class="dropdown-item DataTableVUrl" data-url="' +
                    url +
                    '99" data-action="Supprimé"><i class="la la-trash"></i> Supprimer</span>'
                  : "") +
                "\
						  	</div>\
						</div>\
					"
              );
            }
          }
        ]
      });
    }
    if ($("#delegation_table").length) {
      $("#delegation_table").KTDatatable({
        data: {
          saveState: { cookie: false }
        },
        search: {},
        pagination: false,
        columns: [
          {
            field: "ID",
            title: "#",
            sortable: false,
            width: 20,
            selector: {
              class: "kt-checkbox--solid"
            },
            textAlign: "center"
          },
          {
            field: "Informations personnelles",
            width: 250,
            sortable: false,
            autoHide: false
          },
          {
            field: "Fonction",
            sortable: false,
            autoHide: true
          },
          {
            field: "Type",
            title: "Type",
            sortable: false,
            autoHide: false,
            width: 180,
            // callback function support for column rendering
            template: function(row) {
              var types = {
                1: { title: "Standard", class: "kt-badge--presse" },
                2: {
                  title: "Premium sans hébergement",
                  class: " kt-badge--premium"
                },
                3: {
                  title: "Premium avec hébergement",
                  class: " kt-badge--premium"
                },
                4: {
                  1: {
                    title: "Speaker - Niveau 1",
                    class: " kt-badge--premium"
                  },
                  2: {
                    title: "Speaker - Niveau 2",
                    class: " kt-badge--speaker-2"
                  },
                  3: {
                    title: "Speaker - Niveau 3",
                    class: " kt-badge--speaker-3"
                  }
                },
                5: { title: "Conjoint", class: " kt-badge--premium" },
                6: {
                  1: {
                    title: "Délégation - Niveau 1",
                    class: " kt-badge--premium"
                  },
                  2: {
                    title: "Délégation - Niveau 2",
                    class: " kt-badge--speaker-2"
                  },
                  3: {
                    title: "Délégation - Niveau 3",
                    class: " kt-badge--speaker-3"
                  }
                },
                7: { title: "Presse", class: " kt-badge--presse" },
                8: {
                  title: "Partenaire média",
                  class: " kt-badge--media"
                },
                9: { title: "Sponsor", class: " kt-badge--sponsor" },
                11: {
                  title: "Institut Amadeus",
                  class: " kt-badge--unified-info"
                },
                10: {
                  title: "Organisateur",
                  class: " kt-badge--organisateur"
                },
                12: {
                  title: "Police / Armée / Gendarmerie",
                  class: " kt-badge--unified-info"
                },
                13: {
                  title: "Sécurité",
                  class: " kt-badge--unified-info"
                },
                14: { title: "Staff", class: " kt-badge--unified-info" }
              };
              var classe = "";
              var title = "";
              if ((row.Type != 4 && row.Type != 6) || row.Level.length == 0) {
                classe = types[row.Type].class;
                title = types[row.Type].title;
              } else {
                classe = types[row.Type][row.Level].class;
                title = types[row.Type][row.Level].title;
              }
              return (
                '<span class="kt-badge ' +
                classe +
                ' kt-badge--rounded kt-badge--bold kt-badge--inline">' +
                title +
                "</span>"
              );
            }
          },
          {
            field: "OrderDate",
            type: "date",
            sortable: false,
            format: "YYYY-MM-DD"
          },
          {
            field: "Level",
            sortable: false,
            title: "Level"
          },
          {
            field: "Statut",
            title: "Statut",
            sortable: false,
            autoHide: true,
            // callback function support for column rendering
            template: function(row) {
              var status = {
                1: {
                  title: "En attente",
                  state: "danger orrangecolor"
                },
                2: { title: "Invitation envoyée", state: "primary" },
                3: { title: "Validée", state: "success" },
                4: { title: "Refusée", state: "danger" },
                5: { title: "Désactivé", state: "danger" },
                6: {
                  title: "Demande transport",
                  state: "danger orrangecolor"
                },
                7: {
                  title: "Attente informations transfert",
                  state: "danger orrangecolor"
                },
                8: {
                  title: "Badge en cours d’édition",
                  state: "danger"
                },
                9: { title: "Badge édité", state: "success" },
                10: { title: "Badge livré", state: "success" },
                13: { title: "Attente de validation", state: "info" }
              };
              if (status[row.Statut])
                return (
                  '<span class="kt-badge kt-badge--' +
                  status[row.Statut].state +
                  ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' +
                  status[row.Statut].state +
                  '">' +
                  status[row.Statut].title +
                  "</span>"
                );
              return "";
            }
          },
          {
            field: "Actions",
            title: "Actions",
            sortable: false,
            width: 110,
            overflow: "visible",
            autoHide: false,
            template: function(row) {
              let url = "participant/" + row.ID + "/";
              return (
                '\
						<div class="dropdown">\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
                                <i class="flaticon-more-1"></i>\
                            </a>\
							  <div class="dropdown-menu dropdown-menu-right">\
							  	<span class="dropdown-item DataTableVUrl" data-url="' +
                url +
                '1" data-action="Valider"><i class="la la-check-circle"></i> Valider</span>\
							  	' +
                (["2", "4", "8", "6", "3", "9"].includes(row.Type)
                  ? ' <span class="dropdown-item DataTableVUrl" data-url="' +
                    url +
                    '15" data-action="Envoyer Invitation"><i class="la la-check-circle"></i> Envoyer invitation</span>'
                  : "") +
                '\
						    	<span class="dropdown-item DataTableVUrl" data-url="' +
                url +
                '2" data-action="Refuser"><i class="la la-minus-circle"></i> Refuser</span>\
						    	' +
                (window.has_upgrade || window.is_admin
                  ? '<span class="dropdown-item showUpPop" data-id="' +
                    row.ID +
                    '" data-level="' +
                    row.Level +
                    '" data-type="' +
                    row.Type +
                    '" data-toggle="modal" data-target="#kt_modal_6"><i class="la la-thumbs-o-up"></i> Upgrader</span>'
                  : "") +
                '\
						    	<span class="dropdown-item DataTableVUrl" data-url="' +
                url +
                '4" data-action="Livrer le Badge"><i class="la la-credit-card"></i> Livrer le Badge</span>\
						    	<span class="dropdown-item DataTableVUrlNPOP" data-url="' +
                url +
                '5"><i class="la la-edit"></i> Modifier</span>\
						    	' +
                ('<span class="dropdown-item DataTableVUrl" data-url="' +
                  url +
                  '6" data-action="Désactivé"><i class="la la-close"></i> Désactiver</span>') +
                "\
						    	" +
                (window.is_admin || window.has_delete
                  ? '<span class="dropdown-item DataTableVUrl" data-url="' +
                    url +
                    '99" data-action="Supprimé"><i class="la la-trash"></i> Supprimer</span>'
                  : "") +
                "\
						  	</div>\
						</div>\
					"
              );
            }
          }
        ]
      });
    }
    if ($("#html_table_2").length) {
      $("#html_table_2").KTDatatable({
        data: {
          saveState: { cookie: false }
        },
        search: {},
        pagination: false,
        columns: [
          {
            field: "ID",
            title: "#",
            sortable: false,
            width: 20,
            selector: {
              class: "kt-checkbox--solid"
            },
            textAlign: "center"
          },
          {
            field: "Informations personnelles",
            sortable: false,
            width: 250
          },
          {
            field: "Hotel",
            sortable: false,
            autoHide: true
          },
          {
            field: "Type",
            title: "Type",
            autoHide: false,
            sortable: false,
            width: 180,
            // callback function support for column rendering
            template: function(row) {
              var types = {
                1: { title: "Standard", class: "kt-badge--presse" },
                2: {
                  title: "Premium sans hébergement",
                  class: " kt-badge--premium"
                },
                3: {
                  title: "Premium avec hébergement",
                  class: " kt-badge--premium"
                },
                4: { title: "Speaker - Niveau 1", class: " kt-badge--premium" },
                5: {
                  title: "Speaker - Niveau 2",
                  class: " kt-badge--speaker-2"
                },
                6: {
                  title: "Speaker - Niveau 3",
                  class: " kt-badge--speaker-3"
                },
                7: { title: "Conjoint", class: " kt-badge--unified-brand" },
                8: {
                  title: "Délégation - Niveau 1",
                  class: " kt-badge--unified-brand"
                },
                9: {
                  title: "Délégation - Niveau 2",
                  class: " kt-badge--unified-brand"
                },
                10: {
                  title: "Délégation - Niveau 3",
                  class: " kt-badge--unified-brand"
                },
                11: { title: "Presse", class: " kt-badge--presse" },
                12: { title: "Partenaire média", class: " kt-badge--media" },
                13: { title: "Sponsor", class: " kt-badge--sponsor" },
                14: {
                  title: "Institut Amadeus",
                  class: " kt-badge--unified-info"
                },
                15: { title: "Organisateur", class: " kt-badge--organisateur" },
                16: {
                  title: "Police / Armée / Gendarmerie",
                  class: " kt-badge--unified-info"
                },
                17: { title: "Sécurité", class: " kt-badge--unified-info" },
                18: { title: "Staff", class: " kt-badge--unified-info" }
              };
              return (
                '<span class="kt-badge ' +
                types[row.Type].class +
                ' kt-badge--rounded kt-badge--bold kt-badge--inline">' +
                types[row.Type].title +
                "</span>"
              );
            }
          },
          {
            field: "Date Arrivée",
            type: "date",
            sortable: false,
            format: "YYYY-MM-DD"
          },
          {
            field: "Date Départ",
            type: "date",
            sortable: false,
            format: "YYYY-MM-DD"
          },
          {
            field: "Statut",
            title: "Statut",
            sortable: false,
            autoHide: false,
            // callback function support for column rendering
            template: function(row) {
              var status = {
                1: { title: "En attente", state: "danger" },
                2: { title: "Invitation envoyée", state: "primary" },
                3: { title: "Validée", state: "success" },
                4: { title: "Refusée", state: "success" },
                5: { title: "Désactivée", state: "success" },
                6: { title: "Demande transport", state: "success" },
                7: {
                  title: "Attente informations transfert",
                  state: "success"
                },
                8: { title: "Badge en cours d’édition", state: "success" },
                9: { title: "Badge édité", state: "success" },
                10: { title: "Badge livré", state: "success" },
                13: { title: "Attente de validation", state: "info" }
              };
              return (
                '<span class="kt-badge kt-badge--' +
                status[row.Statut].state +
                ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' +
                status[row.Statut].state +
                '">' +
                status[row.Statut].title +
                "</span>"
              );
            }
          },
          {
            field: "Actions",
            title: "Actions",
            sortable: false,
            width: 110,
            overflow: "visible",
            autoHide: false,
            template: function(row) {
              return (
                '\
						<div class="dropdown">\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
                                <i class="flaticon-more-1"></i>\
                            </a>\
						  	<div class="dropdown-menu dropdown-menu-right">\
						    	<a class="dropdown-item" href="participant/' +
                row.ID +
                '/1"><i class="la la-check-circle"></i> Valider</a>\
						    	<a class="dropdown-item" href="participant/' +
                row.ID +
                '/2"><i class="la la-minus-circle"></i> Refuser</a>\
						    	<a class="dropdown-item" href="participant/' +
                row.ID +
                '/3"><i class="la la-thumbs-o-up"></i> Upgrader</a>\
						    	<a class="dropdown-item" href="participant/' +
                row.ID +
                '/4"><i class="la la-credit-card"></i> Livrer le Badge</a>\
						    	<a class="dropdown-item" href="participant/' +
                row.ID +
                '/5"><i class="la la-edit"></i> Modifier</a>\
						    	<a class="dropdown-item" href="participant/' +
                row.ID +
                '/6"><i class="la la-close"></i> Désactivé</a>\
						    	<a class="dropdown-item" href="participant/' +
                row.ID +
                '/99"><i class="la la-trash"></i> Supprimé</a>\
						  	</div>\
						</div>\
					'
              );
            }
          }
        ]
      });
    }
    if ($("#html_table_3").length) {
      $("#html_table_3").KTDatatable({
        data: {
          saveState: { cookie: false }
        },
        search: {},
        pagination: false,
        columns: [
          {
            field: "ID",
            title: "#",
            sortable: false,
            width: 20,
            selector: {
              class: "kt-checkbox--solid"
            },
            textAlign: "center"
          },
          {
            field: "Actions",
            title: "Actions",
            sortable: false,
            overflow: "visible",
            autoHide: false
          }
        ]
      });
    }
    if ($("#html_table4").length) {
      $("#html_table4").KTDatatable({
        data: {
          saveState: { cookie: false }
        },
        search: {},
        pagination: false,
        columns: [
          {
            field: "ID",
            title: "#",
            sortable: false,
            width: 20,
            selector: {
              class: "kt-checkbox--solid"
            },
            textAlign: "center"
          },
          {
            field: "Informations personnelles",
            sortable: false,
            width: 250
          },
          {
            field: "Fonction",
            sortable: false,
            autoHide: true
          },
          {
            field: "Pays",
            sortable: false
          },
          {
            field: "Date d'inscription",
            sortable: false
          },
          {
            field: "Hotel",
            sortable: false
          },
          {
            field: "Date Arrivée",
            sortable: false
          },
          {
            field: "Date Départ",
            sortable: false
          },
          {
            field: "Nuitées",
            sortable: false
          }, {
            field: "Type de chambre",
            sortable: false
          }, {
            field: "Catégorie de chambre",
            sortable: false
          }, {
            field: "Statut Participant",
            sortable: false
          },
          {
            field: "Aéroport Arrivée",
            sortable: false
          },
          {
            field: "Aéroport Départ",
            sortable: false
          },
          {
            field: "Aéroport Provenance",
            sortable: false
          },
          {
            field: "Aéroport Destination",
            sortable: false
          },
          {
            field: "Heure Arrivée",
            sortable: false
          },
          {
            field: "Heure Départ",
            sortable: false
          },
          {
            field: "PEC",
            sortable: false
          },
          {
            field: "Type",
            title: "Type",
            sortable: false,
            autoHide: false,
            width: 180,
            // callback function support for column rendering
            template: function(row) {
              var types = {
                1: { title: "Standard", class: "kt-badge--presse" },
                2: {
                  title: "Premium sans hébergement",
                  class: " kt-badge--premium"
                },
                3: {
                  title: "Premium avec hébergement",
                  class: " kt-badge--premium"
                },
                4: {
                  1: {
                    title: "Speaker - Niveau 1",
                    class: " kt-badge--premium"
                  },
                  2: {
                    title: "Speaker - Niveau 2",
                    class: " kt-badge--speaker-2"
                  },
                  3: {
                    title: "Speaker - Niveau 3",
                    class: " kt-badge--speaker-3"
                  }
                },
                5: { title: "Conjoint", class: " kt-badge--premium" },
                6: {
                  1: {
                    title: "Délégation - Niveau 1",
                    class: " kt-badge--premium"
                  },
                  2: {
                    title: "Délégation - Niveau 2",
                    class: " kt-badge--speaker-2"
                  },
                  3: {
                    title: "Délégation - Niveau 3",
                    class: " kt-badge--speaker-3"
                  }
                },
                7: { title: "Presse", class: " kt-badge--presse" },
                8: { title: "Partenaire média", class: " kt-badge--media" },
                9: { title: "Sponsor", class: " kt-badge--sponsor" },
                11: {
                  title: "Institut Amadeus",
                  class: " kt-badge--unified-info"
                },
                10: { title: "Organisateur", class: " kt-badge--organisateur" },
                12: {
                  title: "Police / Armée / Gendarmerie",
                  class: " kt-badge--unified-info"
                },
                13: { title: "Sécurité", class: " kt-badge--unified-info" },
                14: { title: "Staff", class: " kt-badge--unified-info" }
              };
              var classe = "";
              var title = "";
              if (!row.Type.includes("@")) {
                classe = types[row.Type].class;
                title = types[row.Type].title;
              } else {
                const type = row.Type.split("@");
                if (types[type[0]][type[1]]) {
                  classe = types[type[0]][type[1]].class;
                  title = types[type[0]][type[1]].title;
                } else {
                  classe = types[type[0]].class;
                  title = types[type[0]].title;
                }
              }
              return (
                '<span class="kt-badge ' +
                classe +
                ' kt-badge--rounded kt-badge--bold kt-badge--inline">' +
                title +
                "</span>"
              );
            }
          },
          {
            field: "OrderDate",
            sortable: false,
            type: "date",
            format: "YYYY-MM-DD"
          },
          {
            field: "Level",
            sortable: false,
            title: "Level"
          },
          {
            field: "Formation",
            sortable: false,
            title: "Formation",
            autoHide: false,
            // callback function support for column rendering
            template: function(row) {
              let temptitle = "";
              if (row.Formation == "1") {
                temptitle = "IE";
              }
              if (row.Formation == "2") {
                temptitle = "ZLECAF";
              }
              return temptitle;
            }
          },
          {
            field: "Status",
            sortable: false,
            title: "Status",
            autoHide: false,
            // callback function support for column rendering
            template: function(row) {
              var status = {
                0: { title: "Aucune", state: "danger" },
                1: { title: "Attente paiement", state: "danger orrangecolor" },
                2: { title: "Annulée", state: "danger" },
                3: { title: "Payée", state: "success" }
              };
              let tempstate = "";
              let temptitle = "";
              if (status[row.Status] != undefined) {
                tempstate = status[row.Status].state;
                temptitle = status[row.Status].title;
              } else {
                tempstate = status[0].state;
                temptitle = status[0].title;
              }
              return (
                '<span class="kt-badge kt-badge--' +
                tempstate +
                ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' +
                tempstate +
                '">' +
                temptitle +
                "</span>"
              );
            }
          },
          {
            field: "Statut",
            sortable: false,
            title: "Statut",
            autoHide: false,
            // callback function support for column rendering
            template: function(row) {
              var status = {
                0: { title: "Aucune", state: "danger" },
                1: { title: "Attente paiement", state: "danger orrangecolor" },
                2: { title: "Payée", state: "success" },
                3: { title: "Annulée", state: "danger" }
              };
              let tempstate = "";
              let temptitle = "";
              if (status[row.Statut] != undefined) {
                tempstate = status[row.Statut].state;
                temptitle = status[row.Statut].title;
              } else {
                tempstate = status[0].state;
                temptitle = status[0].title;
              }
              return (
                '<span class="kt-badge kt-badge--' +
                tempstate +
                ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' +
                tempstate +
                '">' +
                temptitle +
                "</span>"
              );
            }
          }
        ]
      });
    }
		$('#kt_form_status,#kt_form_type').selectpicker();

	};

	var selection = function () {
		// init form controls
		// $('#kt_form_status, #kt_form_type').selectpicker();

		if ($('#html_table_2').length)
			return false;

		// event handler on check and uncheck on records
		if(datatable){
			datatable.on('kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated', function (e) {
				var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes(); // get selected records
				var count = checkedNodes.length; // selected records count
				$('#kt_subheader_group_selected_rows').html(count);

				if (count > 0) {
					$('#kt_subheader_search, .kt-participants--filter').addClass('kt-hidden');
					$('#kt_subheader_group_actions').removeClass('kt-hidden');
				} else {
					$('#kt_subheader_search, .kt-participants--filter').removeClass('kt-hidden');
					$('#kt_subheader_group_actions').addClass('kt-hidden');
				}
			});
		}
	}

	var openDetails = function () {
		setTimeout(function() {
			$('body').find('.kt-datatable__toggle-detail').trigger('click');
		}, 1000);
	}

	return {
		// Public functions
		init: function() {
			// init dmeo
			demo();
			selection();
			// openDetails();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableHtmlTableDemo.init();
	$('.dataTablePagination').css('display', 'block')
});